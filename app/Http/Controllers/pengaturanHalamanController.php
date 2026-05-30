<?php

namespace App\Http\Controllers;

use App\Models\metadata;
use App\Models\halaman; // Pastikan nama model halaman Anda sesuai (misal: halaman)
// use App\Models\Skill; // Jika data Interest diambil dari tabel Skill, import di sini
use Illuminate\Http\Request;

class pengaturanhalamanController extends Controller
{
    public function index()
    {
        // 1. Ambil daftar opsi dari tabel lain untuk isi drop-down <select>
        // Sesuaikan dengan nama model dan kolom yang Anda miliki saat ini
        $daftar_halaman = halaman::orderBy('judul', 'asc')->get(); 
        
        // 2. Ambil data konfigurasi aktif yang sudah tersimpan di tabel metadata
        $set_about    = metadata::where('meta_key', '_halaman_about')->first();
        $set_interest = metadata::where('meta_key', '_halaman_interest')->first();
        $set_award    = metadata::where('meta_key', '_halaman_award')->first();

        return view('dashboard.pengaturanhalaman.index', compact(
            'daftar_halaman', 'set_about', 'set_interest', 'set_award'
        ));
    }

    public function update(Request $request)
    {
        // Validasi input pastikan data yang dipilih valid
        $request->validate([
            '_halaman_about'    => 'nullable',
            '_halaman_interest' => 'nullable',
            '_halaman_award'    => 'nullable',
        ]);

        // Simpan atau perbarui pilihan ID halaman ke tabel metadata
        metadata::updateOrCreate(['meta_key' => '_halaman_about'], ['meta_value' => $request->_halaman_about]);
        metadata::updateOrCreate(['meta_key' => '_halaman_interest'], ['meta_value' => $request->_halaman_interest]);
        metadata::updateOrCreate(['meta_key' => '_halaman_award'], ['meta_value' => $request->_halaman_award]);

        return redirect()->route('pengaturanhalaman.index')->with('success', 'Berhasil memperbarui pengaturan tata letak halaman.');
    }
}