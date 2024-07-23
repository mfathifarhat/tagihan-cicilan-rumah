<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // Schema::create('rumahs', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('gambar');
        //     $table->text('alamat');
        //     $table->integer('jumlah_kamar');
        //     $table->integer('luas_tanah');
        //     $table->integer('luas_bangunan');
        //     $table->enum('status', ['Tersedia', 'Terjual'])->default('Tersedia');
        //     $table->bigInteger('harga');
        //     $table->timestamps();
        // });

        Schema::create('rumahs', function (Blueprint $table) {
            $table->string('blok')->primary();
            $table->string('gambar');
            $table->integer('jumlah_kamar');
            $table->integer('luas_tanah');
            $table->integer('luas_bangunan');
            $table->bigInteger('harga');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rumahs');
    }
};
