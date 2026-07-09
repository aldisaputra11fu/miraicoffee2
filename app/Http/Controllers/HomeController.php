<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Barang; 

class HomeController extends Controller
{
    
    public function __construct()
    {
        $this->middleware('auth');
    }

   
    public function index()
    {
        
        $kopis = Barang::where('kategori', 'kopi')->get();
        $makanans = Barang::where('kategori', 'makanan')->get();

        // 2. Kirim kedua variabel tersebut ke tampilan (view)
        // (Pastikan nama view-nya sesuai, biasanya 'dashboard' atau 'home')
        return view('dashboard', compact('kopis', 'makanans'));
    }
}