<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class sertifikat extends Model
{
    use HasFactory;

    // Nama tabel di database (menghindari otomatisasi jamak bahasa Inggris Laravel)
    protected $table = 'sertifikats';

    /**
     * Kolom yang diizinkan untuk diisi via form request (Mass Assignment)
     */
    protected $fillable = [
        'name',           // Nama Sertifikasi
        'issuing_org',    // Organisasi Penerbit
        'issued_date',    // Tanggal Terbit
        'credential_id',  // ID Kredensial (SK/No Sertifikat)
        'credential_url', // URL Kredensial (Link Verifikasi)
        'description',    // Deskripsi Tambahan
        'file_cert',      // Nama File Fisik Gambar/PDF Sertifikat
    ];

    /**
     * Cast kolom tanggal menjadi objek Carbon otomatis
     */
    protected $casts = [
        'issued_date' => 'date',
    ];
}