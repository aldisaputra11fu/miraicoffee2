<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    use HasFactory;

    public function pesanan_detail(): HasMany
    {
        // Parameter kedua adalah Foreign Key di tabel pesanan_details (barang_id)
        // Parameter ketiga adalah Local Key di tabel barangs (id)
        return $this->hasMany(PesananDetail::class, 'barang_id', 'id');
    }
    protected $fillable = [
        'nama_barang',
        'kategori', // Tambahkan ini
        'harga',
        'stok',
        'keterangan',
        'gambar'
    ];
} // Kurung kurawal penutup kelas harus berada di akhir file
