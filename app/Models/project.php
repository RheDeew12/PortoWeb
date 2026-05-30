<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class project extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'projects';

    // Kolom yang diizinkan untuk diisi via form request
    protected $fillable = [
        'title',
        'description',
        'tools',
        'image',
        'link_github',
        'link_live',
    ];
}