<?php

namespace App\Http\Controllers;

use App\Models\Pesanan;
use App\Models\Barang; // Pastikan ini sudah dipanggil
use Illuminate\Http\Request;
use App\Models\Topping;

class AdminController extends Controller
{
    public function index()
    {
        $pesanans = Pesanan::where('status', 1)->orderBy('tanggal', 'desc')->get();
        return view('admin.index', compact('pesanans'));
    }

    // 1. Fungsi menampilkan halaman form tambah barang
    public function create()
    {
        return view('admin.create_barang');
    }

    // 2. Fungsi memproses pengunggahan & penyimpanan data barang baru
    public function store(Request $request)
    {
        // Validasi input data form
        $request->validate([
            'nama_barang' => 'required|string|max:255',
            'kategori'    => 'required|string|in:kopi,makanan',
            'harga'       => 'required|numeric',
            'stok'        => 'required|integer',
            'keterangan'  => 'required|string',
            'gambar'      => 'nullable|image|mimes:jpeg,png,jpg|max:2048', // Maksimal 2MB
        ]);

        $barang = new Barang;
        $barang->nama_barang = $request->nama_barang;
        $barang->kategori = $request->kategori;
        $barang->harga = $request->harga;
        $barang->stok = $request->stok;
        $barang->keterangan = $request->keterangan;

        // Logika untuk mengunggah gambar ke folder public/uploads/
        if ($request->hasFile('gambar')) {
            $file = $request->file('gambar');
            $nama_gambar = time() . '_' . $file->getClientOriginalName();
            $file->move(public_path('uploads'), $nama_gambar);
            $barang->gambar = $nama_gambar;
        } else {
            $barang->gambar = 'default.png'; // Jika tidak upload gambar, pakai default
        }

        $barang->save();

        return redirect()->route('admin')->with('success', 'Menu kopi baru berhasil ditambahkan!');
    }
    // Fungsi untuk menampilkan Laporan Penjualan
    public function laporan()
    {
        // Ambil semua pesanan yang sudah dicheckout (status 1 atau 2)
        // Urutkan dari yang terbaru
        $pesanans = Pesanan::where('status', '!=', 0)->orderBy('tanggal', 'desc')->get();
        
        // Hitung total pendapatan dan total transaksi
        $total_pendapatan = 0;
        $total_transaksi = $pesanans->count();

        foreach($pesanans as $pesanan) {
            $total_pendapatan += ($pesanan->jumlah_harga + $pesanan->kode);
        }

        return view('admin.laporan', compact('pesanans', 'total_pendapatan', 'total_transaksi'));
    }
    // Fungsi untuk mengubah status pesanan dari "Diproses" menjadi "Selesai"
    public function updateStatus($id)
    {
        // Cari data pesanan berdasarkan ID
        $pesanan = Pesanan::findOrFail($id);
        
        // Ubah status menjadi 2 (Selesai)
        $pesanan->status = 2;
        $pesanan->update();

        // Kembalikan ke halaman laporan dengan pesan sukses
        return redirect()->back()->with('success', 'Status pesanan berhasil diperbarui menjadi Selesai!');
    }
    // --- MANAJEMEN TOPPING ---

    // 1. Menampilkan halaman daftar topping
    public function toppingIndex()
    {
        // Mengambil semua data topping dan diurutkan berdasarkan kategorinya
        $toppings = Topping::orderBy('kategori_makanan', 'asc')->get();
        return view('admin.topping', compact('toppings'));
    }

    // 2. Menyimpan data topping baru ke database
    public function toppingStore(Request $request)
    {
        Topping::create([
            'nama_topping' => $request->nama_topping,
            'harga' => $request->harga,
            'kategori_makanan' => $request->kategori_makanan,
        ]);

        return redirect()->back()->with('success', 'Topping baru berhasil ditambahkan!');
    }

    // 3. Menghapus data topping
    public function toppingDestroy($id)
    {
        $topping = Topping::findOrFail($id);
        $topping->delete();

        return redirect()->back()->with('success', 'Topping berhasil dihapus!');
    }
    // --- MANAJEMEN STOK ---

    // 1. Menampilkan halaman daftar stok barang
    public function stokIndex()
    {
        // Ambil semua data menu/barang dari database
        $barangs = Barang::all();
        return view('admin.stok', compact('barangs'));
    }

    // 2. Memproses penambahan stok barang
    public function tambahStok(Request $request, $id)
    {
        $barang = Barang::findOrFail($id);
        
        // Logika Pintar: Stok Lama + Inputan Stok Baru
        $barang->stok = $barang->stok + $request->tambahan_stok;
        $barang->update();

        return redirect()->back()->with('success', 'Stok ' . $barang->nama_barang . ' berhasil ditambah sebanyak ' . $request->tambahan_stok . ' porsi/gelas!');
    }
}