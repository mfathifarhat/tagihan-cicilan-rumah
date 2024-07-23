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
        Schema::create('customers', function (Blueprint $table) {
            $table->id();
            $table->string('rumah_id');
            $table->string('nama');
            $table->string('email')->unique();
            $table->string('password');
            $table->text('alamat');
            $table->string('no_hp', 15);
            $table->timestamps();


            $table->foreign('rumah_id')->references('blok')->on('rumahs')->cascadeOnDelete()->cascadeOnDelete();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('customers');
    }
};
