<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang;
use App\Models\Pesanan;
use App\Models\PesananDetail;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Models\Topping;
use App\Models\Ulasan;

class PesanController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    // 1. Fungsi untuk menampilkan halaman form pesan
    public function index($id)
    {
        $barang = Barang::where('id', $id)->first();
        $toppings = Topping::all();
        
        // Ambil semua ulasan untuk menu ini dan urutkan dari yang terbaru
        $ulasans = Ulasan::where('barang_id', $id)->orderBy('created_at', 'desc')->get();
        
        return view('pesan.index', compact('barang', 'toppings', 'ulasans'));
    }

    // 2. Fungsi untuk menyimpan pesanan dari form ke keranjang (database)
    public function pesan(Request $request, $id)
    {
        $barang = Barang::where('id', $id)->first();
        $tanggal = Carbon::now();

        // Validasi: Cegah user memesan melebihi stok yang tersedia di toko
        if($request->jumlah_pesan > $barang->stok) {
            return redirect('pesan/'.$id);
        }

        // Cek apakah user punya "Keranjang Belanja" yang masih aktif (status = 0)
        $cek_pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();

        // Jika belum punya keranjang aktif, buatkan nota keranjang baru
        if(empty($cek_pesanan)) {
            $pesanan = new Pesanan;
            $pesanan->user_id = Auth::user()->id;
            $pesanan->tanggal = $tanggal;
            $pesanan->status = 0; // 0 = Belum Checkout
            $pesanan->jumlah_harga = 0; 
            $pesanan->kode = mt_rand(100, 999); // Kode unik keamanan transfer
            $pesanan->save();
        }

        // Ambil data keranjang yang baru dibuat atau yang sedang aktif
        $pesanan_baru = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();

        // ================= LOGIKA HARGA TOPPING DINAMIS =================
        $topping_raw = $request->topping;
        $topping_array = is_array($topping_raw) ? $topping_raw : ($topping_raw ? [$topping_raw] : []);
        $topping_string = empty($topping_array) ? 'Tanpa Topping' : implode(', ', $topping_array);

        $harga_tambahan = 0;
        
        foreach ($topping_array as $top) {
            // Abaikan radio button (seperti 'Base Normal' atau 'Rasa Vanilla') 
            // karena itu adalah sifat dasar makanan, bukan tambahan berbayar dari database.
            if (str_starts_with($top, 'Base') || str_starts_with($top, 'Adonan') || str_starts_with($top, 'Isian') || str_starts_with($top, 'Rasa')) {
                continue;
            }

            // Cari nama topping tersebut di database
            $cek_topping_db = Topping::where('nama_topping', $top)->first();
            
            // Jika ketemu di database, tambahkan harganya ke total!
            if ($cek_topping_db) {
                $harga_tambahan += $cek_topping_db->harga;
            }
        }

        // Harga final 1 porsi/gelas = Harga asli menu + Harga total topping dari Database
        $harga_satuan = $barang->harga + $harga_tambahan;
        // ================================================================

        // Cek apakah pesanan dengan rincian (kemanisan, suhu, topping) yang SAMA PERSIS sudah ada di keranjang
        $cek_pesanan_detail = PesananDetail::where('barang_id', $barang->id)
                                           ->where('pesanan_id', $pesanan_baru->id)
                                           ->where('kemanisan', $request->kemanisan)
                                           ->where('kepahitan', $request->kepahitan)
                                           ->where('suhu', $request->suhu) 
                                           ->where('topping', $topping_string)
                                           ->first();

        // Jika rincian menu tersebut belum ada di keranjang, buat baris pesanan baru!
        if(empty($cek_pesanan_detail)) {
            $pesanan_detail = new PesananDetail;
            $pesanan_detail->barang_id = $barang->id;
            $pesanan_detail->pesanan_id = $pesanan_baru->id;
            $pesanan_detail->jumlah = $request->jumlah_pesan;
            $pesanan_detail->kemanisan = $request->kemanisan; 
            $pesanan_detail->kepahitan = $request->kepahitan;
            $pesanan_detail->suhu = $request->suhu; 
            $pesanan_detail->topping = $topping_string; 
            
            // Harga total item ini = Harga satuan baru x Jumlah yang dipesan
            $pesanan_detail->jumlah_harga = $harga_satuan * $request->jumlah_pesan;
            $pesanan_detail->save();
        } 
        // Jika rincian menu persis sama sudah ada di keranjang, cukup tambahkan JUMLAH-nya saja (tidak perlu buat baris baru)
        else {
            $cek_pesanan_detail->jumlah = $cek_pesanan_detail->jumlah + $request->jumlah_pesan;
            $cek_pesanan_detail->jumlah_harga = $cek_pesanan_detail->jumlah_harga + ($harga_satuan * $request->jumlah_pesan);
            $cek_pesanan_detail->update();
        }

        // Langkah Terakhir: Update total biaya keseluruhan di nota Keranjang (Pesanan Utama)
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $pesanan->jumlah_harga = $pesanan->jumlah_harga + ($harga_satuan * $request->jumlah_pesan);
        $pesanan->update();

        return redirect('home')->with('success', 'Pesanan berhasil ditambahkan ke keranjang!');
    }

    // 3. Fungsi menampilkan halaman Keranjang Belanja (Checkout)
    public function checkout()
    {
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        
        // Cek dan tampilkan jika ada barang di dalam keranjang
        if(!empty($pesanan)) {
            $pesanan_details = PesananDetail::where('pesanan_id', $pesanan->id)->get();
            return view('pesan.checkout', compact('pesanan', 'pesanan_details'));
        }

        return view('pesan.checkout', compact('pesanan'));
    }

    // 4. Fungsi menghapus salah satu barang dari dalam keranjang
    public function delete($id)
    {
        $pesanan_detail = PesananDetail::where('id', $id)->first();
        
        // Kurangi total harga di nota keranjang dengan harga barang yang dihapus
        $pesanan = Pesanan::where('id', $pesanan_detail->pesanan_id)->first();
        $pesanan->jumlah_harga = $pesanan->jumlah_harga - $pesanan_detail->jumlah_harga;
        $pesanan->update();

        // Hapus data barang dari tabel detail pesanan
        $pesanan_detail->delete();

        // Jika keranjang benar-benar kosong setelah dihapus, hapus sekalian nota keranjangnya
        if (PesananDetail::where('pesanan_id', $pesanan->id)->count() == 0) {
            $pesanan->delete();
        }

        return redirect('checkout')->with('success', 'Pesanan berhasil dihapus dari keranjang!');
    }

    // 5. Fungsi memproses "Check Out" & mengirim struk via WhatsApp
    public function konfirmasi()
    {
        $pesanan = Pesanan::where('user_id', Auth::user()->id)->where('status', 0)->first();
        $pesanan_id = $pesanan->id;
        
        // Ubah status nota dari 0 (Dalam Keranjang) menjadi 1 (Sudah Dipesan/Checkout)
        $pesanan->status = 1;
        $pesanan->update();

        // Ambil semua barang yang dibeli untuk dikurangi stok aslinya dan dicatat di WA
        $pesanan_details = PesananDetail::where('pesanan_id', $pesanan_id)->get();
        
        // Susun teks struk pesanan untuk dikirim ke Admin via WhatsApp
        $teks_wa = "Halo Admin Mirai Coffee! ☕\nSaya ingin mengkonfirmasi pesanan saya:\n\n";
        $teks_wa .= "👤 *Nama:* " . Auth::user()->name . "\n";
        $teks_wa .= "📱 *No HP:* " . Auth::user()->nohp . "\n";
        $teks_wa .= "📍 *Alamat:* " . Auth::user()->alamat . "\n\n";
        $teks_wa .= "🛒 *DETAIL PESANAN:*\n";
        
        foreach ($pesanan_details as $pesanan_detail) {
            // Kurangi stok barang di tabel master Barang
            $barang = Barang::where('id', $pesanan_detail->barang_id)->first();
            $barang->stok = $barang->stok - $pesanan_detail->jumlah;
            $barang->update();

            // Masukkan rincian pesanan ke teks WhatsApp
            $teks_wa .= "- " . $barang->nama_barang . " (" . $pesanan_detail->jumlah . "x)\n";
            if($pesanan_detail->suhu) { $teks_wa .= "   └ Penyajian: " . $pesanan_detail->suhu . "\n"; }
            if($pesanan_detail->kemanisan) { $teks_wa .= "   └ Manis: " . $pesanan_detail->kemanisan . "\n"; }
            if($pesanan_detail->kepahitan) { $teks_wa .= "   └ Pahit: " . $pesanan_detail->kepahitan . "\n"; }
            if($pesanan_detail->topping && $pesanan_detail->topping != 'Tanpa Topping') { 
                $teks_wa .= "   └ Topping: " . $pesanan_detail->topping . "\n"; 
            }
        }

        // Total Transfer = Total Belanja + Kode Keamanan 3 digit
        $total_transfer = $pesanan->jumlah_harga + $pesanan->kode;
        $teks_wa .= "\n💵 *TOTAL PEMBAYARAN:* \n*Rp. " . number_format($total_transfer, 0, ',', '.') . "*\n";
        $teks_wa .= "_(Sudah termasuk kode unik keamanan: " . $pesanan->kode . ")_\n\n";
        $teks_wa .= "Mohon segera diproses ya Min. Terima kasih!";

        // Buka link WhatsApp API secara otomatis
        $no_wa_admin = "6288801931591"; 
        $url_wa = "https://api.whatsapp.com/send?phone=" . $no_wa_admin . "&text=" . urlencode($teks_wa);

        return redirect($url_wa); 
    } 

    // 6. Fungsi menampilkan halaman Riwayat Transaksi
    public function riwayat()
    {
        // Ambil nota pesanan milik user yang sedang login dan statusnya BUKAN 0 (sudah checkout)
        $pesanans = Pesanan::where('user_id', Auth::user()->id)
                            ->where('status', '!=', 0)
                            ->orderBy('tanggal', 'desc')
                            ->get();

        return view('pesan.riwayat', compact('pesanans'));
    } 

    // 7. Fungsi untuk menyimpan ulasan dari pelanggan
    public function kirimUlasan(Request $request, $id)
    {
        Ulasan::create([
            'user_id' => Auth::user()->id,
            'barang_id' => $id,
            'bintang' => $request->bintang,
            'komentar' => $request->komentar
        ]);

        return redirect()->back()->with('success', 'Terima kasih! Ulasan dan rating Anda berhasil dikirim.');
    }

}