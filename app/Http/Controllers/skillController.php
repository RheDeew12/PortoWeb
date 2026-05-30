<?php

namespace App\Http\Controllers;

use App\Models\metadata; // Memastikan model metadata ter-import
use Illuminate\Http\Request;

class skillController extends Controller
{
    /**
     * Display the skills management page.
     */
    public function index()
    {
        // 1. Mengambil data dari database
        $language = metadata::where('meta_key', '_language')->first();
        $workflow = metadata::where('meta_key', '_workflow')->first();

        // 2. Membaca Devicon JSON untuk dijadikan Default Value Autocomplete
        $skill_url = public_path('admin/devicon.json');
        $skill = ""; 

        if (file_exists($skill_url)) {
            $skill_data = file_get_contents($skill_url);
            $skill_data = json_decode($skill_data, true); 
            
            // Mengambil hanya properti 'name' dari dalam array JSON
            $skill_list = array_column($skill_data, 'name'); 
            
            // PERBAIKAN UTAMA: Bungkus setiap item dengan tanda kutip tunggal (') agar dibaca sebagai string oleh JavaScript
            $skill = "'" . implode("', '", $skill_list) . "'"; 
        }

        // 3. Mengirimkan variabel ke View
        return view('dashboard.skill.index', compact('language', 'workflow', 'skill'));
    }

    /**
     * Update the skills data in storage.
     */
    public function update(Request $request)
    {
        $request->validate([
            '_language' => 'required',
            '_workflow' => 'required'
        ], [
            '_language.required' => 'Silahkan masukkan bahasa pemrograman yang kamu kuasai!',
            '_workflow.required' => 'Silahkan masukkan workflow yang kamu kuasai!'
        ]);

        metadata::updateOrCreate(
            ['meta_key' => '_language'], 
            ['meta_value' => $request->_language] 
        );

        metadata::updateOrCreate(
            ['meta_key' => '_workflow'], 
            ['meta_value' => $request->_workflow] 
        );

        return redirect()->route('skill.index')->with('success', 'Berhasil memperbarui data keahlian Anda.');
    }
}