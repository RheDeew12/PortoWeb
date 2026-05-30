<?php

namespace App\Http\Controllers;

use App\Models\Project;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class projectController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data project urut dari yang terbaru
        $data = Project::orderBy('created_at', 'desc')->get();
        return view('dashboard.project.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Membaca devicon.json untuk kebutuhan autocomplete tokenfield di form tambah
        $skill_url = public_path('admin/devicon.json');
        $skill = ""; 
        if (file_exists($skill_url)) {
            $skill_data = json_decode(file_get_contents($skill_url), true); 
            $skill_list = array_column($skill_data, 'name'); 
            $skill = "'" . implode("', '", $skill_list) . "'"; 
        }

        return view('dashboard.project.create', compact('skill'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Batas maksimal 2MB
        ], [
            'title.required'       => 'Judul proyek wajib diisi!',
            'description.required' => 'Deskripsi proyek wajib diisi!',
            'image.image'          => 'Berkas yang diunggah harus berupa gambar!',
            'image.max'            => 'Ukuran gambar maksimal adalah 2MB!',
        ]);

        $data = [
            'title'       => $request->title,
            'description' => $request->description,
            'tools'       => $request->tools,
            'link_github' => $request->link_github,
            'link_live'   => $request->link_live,
        ];

        // Proses Upload Gambar Proyek jika ada file yang diunggah
        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $image_name = time() . "_" . $image->getClientOriginalName();
            
            // Simpan ke folder public/admin/images/projects
            $destinationPath = public_path('admin/images/projects');
            $image->move($destinationPath, $image_name);
            
            $data['image'] = $image_name;
        }

        Project::create($data);

        return redirect()->route('project.index')->with('success', 'Berhasil menambahkan data proyek baru.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Tidak digunakan, dialihkan ke index
        return redirect()->route('project.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $project = Project::findOrFail($id);

        // Membaca devicon.json untuk kebutuhan autocomplete tokenfield di form edit
        $skill_url = public_path('admin/devicon.json');
        $skill = ""; 
        if (file_exists($skill_url)) {
            $skill_data = json_decode(file_get_contents($skill_url), true); 
            $skill_list = array_column($skill_data, 'name'); 
            $skill = "'" . implode("', '", $skill_list) . "'"; 
        }

        return view('dashboard.project.edit', compact('project', 'skill'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $project = Project::findOrFail($id);

        $request->validate([
            'title'       => 'required|string|max:255',
            'description' => 'required',
            'image'       => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ], [
            'title.required'       => 'Judul proyek wajib diisi!',
            'description.required' => 'Deskripsi proyek wajib diisi!',
            'image.image'          => 'Berkas yang diunggah harus berupa gambar!',
            'image.max'            => 'Ukuran gambar maksimal adalah 2MB!',
        ]);

        $data = [
            'title'       => $request->title,
            'description' => $request->description,
            'tools'       => $request->tools,
            'link_github' => $request->link_github,
            'link_live'   => $request->link_live,
        ];

        if ($request->hasFile('image')) {
            // Hapus gambar lama dari server jika ada gambar baru yang masuk
            if ($project->image && File::exists(public_path('admin/images/projects/' . $project->image))) {
                File::delete(public_path('admin/images/projects/' . $project->image));
            }

            $image = $request->file('image');
            $image_name = time() . "_" . $image->getClientOriginalName();
            $destinationPath = public_path('admin/images/projects');
            $image->move($destinationPath, $image_name);
            
            $data['image'] = $image_name;
        }

        $project->update($data);

        return redirect()->route('project.index')->with('success', 'Berhasil memperbarui data proyek.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $project = Project::findOrFail($id);

        // Hapus file gambar terkait dari storage lokal sebelum menghapus record database
        if ($project->image && File::exists(public_path('admin/images/projects/' . $project->image))) {
            File::delete(public_path('admin/images/projects/' . $project->image));
        }

        $project->delete();

        return redirect()->route('project.index')->with('success', 'Berhasil menghapus data proyek.');
    }
}