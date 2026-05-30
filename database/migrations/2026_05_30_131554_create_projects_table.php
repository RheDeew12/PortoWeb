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
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title');                // Nama/Judul Proyek
            $table->text('description');            // Deskripsi lengkap (bisa diisi via Summernote)
            $table->string('tools')->nullable();    // Teknologi yang digunakan (bisa diisi via Tokenfield, misal: Laravel, Vue)
            $table->string('image')->nullable();    // Nama file foto/screenshoot proyek
            $table->string('link_github')->nullable(); // Tautan repositori GitHub
            $table->string('link_live')->nullable();   // Tautan demo aplikasi langsung (jika ada)
            $table->timestamps();                   // Kolom otomatis created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('projects');
    }
};