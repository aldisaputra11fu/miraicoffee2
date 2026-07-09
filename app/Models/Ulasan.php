<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ulasan extends Model
{
    use HasFactory;
    protected $fillable = ['user_id', 'barang_id', 'bintang', 'komentar'];
public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
