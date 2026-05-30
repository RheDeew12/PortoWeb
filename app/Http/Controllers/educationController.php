<?php

namespace App\Http\Controllers;

use App\Models\riwayat; // Tetap menggunakan model riwayat yang sama
use Illuminate\Http\Request;

class educationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // KUNCI: Filter hanya data yang bertipe 'education'
        $data = riwayat::where('tipe', 'education')->orderBy('tgl_mulai', 'desc')->get();
        return view('dashboard.education.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.education.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'judul' => 'required',     // Bertindak sebagai Nama Jurusan / Prodi
                'info1' => 'required',     // UPDATE: Bertindak sebagai Nama Universitas / Sekolah
                'info2' => 'required',     // UPDATE: Bertindak sebagai Nama Fakultas
                'info3' => 'nullable',     // UPDATE: Bertindak sebagai IPK / GPA (Opsional)
                'tgl_mulai' => 'required|date',
                'tgl_akhir' => 'nullable|date|after_or_equal:tgl_mulai',
                'isi' => 'nullable',       // Deskripsi pencapaian/skripsi (Opsional)
            ],
            [
                'judul.required' => 'Nama Jurusan / Program Studi wajib diisi',
                'info1.required' => 'Nama Universitas / Sekolah wajib diisi',
                'info2.required' => 'Nama Fakultas wajib diisi',
                'tgl_mulai.required' => 'Tanggal mulai pendidikan wajib diisi',
                'tgl_akhir.after_or_equal' => 'Tanggal kelulusan tidak boleh mendahului tanggal mulai belajar',
            ]
        );

        $data = [
            'judul' => $request->judul,
            'tipe' => 'education', 
            'info1' => $request->info1,    // Universitas
            'info2' => $request->info2,    // Fakultas
            'info3' => $request->info3,    // IPK / GPA
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_akhir' => $request->tgl_akhir,
            'isi' => $request->isi
        ];

        riwayat::create($data);

        return redirect()->route('education.index')->with('success', 'Berhasil menambahkan riwayat pendidikan baru');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Pastikan data yang diedit memang bertipe education untuk keamanan
        $data = riwayat::where('id', $id)->where('tipe', 'education')->firstOrFail();
        return view('dashboard.education.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $request->validate(
            [
                'judul' => 'required',
                'info1' => 'required',
                'info2' => 'required',
                'info3' => 'nullable',
                'tgl_mulai' => 'required|date',
                'tgl_akhir' => 'nullable|date|after_or_equal:tgl_mulai',
                'isi' => 'nullable',
            ],
            [
                'judul.required' => 'Nama Jurusan / Program Studi wajib diisi',
                'info1.required' => 'Nama Universitas / Sekolah wajib diisi',
                'info2.required' => 'Nama Fakultas wajib diisi',
                'tgl_mulai.required' => 'Tanggal mulai pendidikan wajib diisi',
                'tgl_akhir.after_or_equal' => 'Tanggal kelulusan tidak boleh mendahului tanggal mulai belajar',
            ]
        );

        $data = [
            'judul' => $request->judul,
            'info1' => $request->info1,    // Universitas
            'info2' => $request->info2,    // Fakultas
            'info3' => $request->info3,    // IPK / GPA
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_akhir' => $request->tgl_akhir,
            'isi' => $request->isi
        ];

        riwayat::where('id', $id)->where('tipe', 'education')->update($data);

        // PERBAIKAN: Mengubah ->with('with', ...) menjadi ->with('success', ...)
        return redirect()->route('education.index')->with('success', 'Berhasil memperbarui data pendidikan');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = riwayat::where('id', $id)->where('tipe', 'education')->firstOrFail();
        $data->delete();

        return redirect()->route('education.index')->with('success', 'Berhasil menghapus data pendidikan');
    }
}