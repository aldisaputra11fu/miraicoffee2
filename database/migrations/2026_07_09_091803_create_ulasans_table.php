<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ulasans', function (Blueprint $table) {
            $table->id();
            // Menghubungkan ulasan dengan user/pelanggan
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            // Menghubungkan ulasan dengan menu barang
            $table->foreignId('barang_id')->constrained('barangs')->onDelete('cascade');
            
            $table->integer('bintang'); // Menyimpan angka 1 sampai 5
            $table->text('komentar');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('ulasans');
    }
};
