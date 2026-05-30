<?php

namespace App\Http\Controllers;

use App\Models\metadata;
use Illuminate\Http\Request;

class interestController extends Controller
{
    /**
     * Tampilkan halaman form pengaturan minat / keahlian (Interest).
     */
    public function index()
    {
        // Membaca berkas devicon.json untuk kebutuhan autocomplete tokenfield jika ada
        $skill_url = public_path('admin/devicon.json');
        $skill = ""; 
        if (file_exists($skill_url)) {
            $skill_data = json_decode(file_get_contents($skill_url), true); 
            $skill_list = array_column($skill_data, 'name'); 
            $skill = "'" . implode("', '", $skill_list) . "'"; 
        }

        // Mengambil data interest aktif yang tersimpan di tabel metadata
        $interest = metadata::where('meta_key', '_interest')->first();

        return view('dashboard.interest.index', compact('skill', 'interest'));
    }

    /**
     * Simpan atau perbarui data interest ke tabel metadata.
     */
    public function update(Request $request)
    {
        // Validasi input form
        $request->validate([
            '_interest' => 'required',
        ], [
            '_interest.required' => 'Kolom minat / keahlian (Interest) wajib diisi!',
        ]);

        // Menyimpan atau memperbarui data menggunakan updateOrCreate
        metadata::updateOrCreate(
            ['meta_key' => '_interest'],
            ['meta_value' => $request->_interest]
        );

        return redirect()->route('interest.index')->with('success', 'Berhasil memperbarui data minat dan keahlian Anda.');
    }
}