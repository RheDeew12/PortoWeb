<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class interest extends Model
{
    use HasFactory;

    // Menghubungkan model ini secara khusus ke tabel metadata yang sudah Anda miliki
    protected $table = 'metadata';

    /**
     * Kolom yang diizinkan untuk diisi (Mass Assignment)
     */
    protected $fillable = [
        'meta_key', 
        'meta_value'
    ];
}