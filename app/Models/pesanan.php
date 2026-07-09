<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class pesanan extends Model
{
    use HasFactory;

    // Nama tabel jika tidak mengikuti aturan jamak Laravel (optional)
    protected $table = 'pesanans'; 

    public function user(): BelongsTo
    {
        // Menggunakan ::class lebih aman daripada string biasa
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function pesanan_detail(): HasMany
    {
        // Menggunakan ::class lebih aman daripada string biasa
        return $this->hasMany(PesananDetail::class, 'pesanan_id', 'id');
    }
}