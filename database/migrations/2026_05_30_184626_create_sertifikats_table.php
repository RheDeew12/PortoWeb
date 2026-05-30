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
        Schema::create('sertifikats', function (Blueprint $table) {
            $table->id();
            $table->string('name');                          // Nama Sertifikasi
            $table->string('issuing_org');                   // Organisasi/Lembaga Penerbit
            $table->date('issued_date');                     // Tanggal Terbit Sertifikat
            $table->string('credential_id')->nullable();     // ID Kredensial / No. Sertifikat
            $table->string('credential_url')->nullable();    // URL Link Verifikasi Kredensial
            $table->text('description')->nullable();         // Deskripsi/Keterangan Kompetensi
            $table->string('file_cert')->nullable();         // Nama file fisik sertifikat (PDF/Gambar)
            $table->timestamps();                            // Kolom otomatis created_at & updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sertifikats');
    }
};