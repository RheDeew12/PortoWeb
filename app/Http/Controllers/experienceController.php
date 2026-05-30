<?php

namespace App\Http\Controllers;

use App\Models\riwayat; // Menggunakan model riwayat
use Illuminate\Http\Request;

class experienceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // KUNCI: Filter hanya data yang bertipe 'experience'
        $data = riwayat::where('tipe', 'experience')->orderBy('tgl_mulai', 'desc')->get();
        return view('dashboard.experience.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.experience.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate(
            [
                'judul' => 'required', // Bertindak sebagai Posisi
                'info1' => 'required', // Bertindak sebagai Perusahaan
                'tgl_mulai' => 'required|date',
                'tgl_akhir' => 'nullable|date|after_or_equal:tgl_mulai',
                'isi' => 'required',
            ],
            [
                'judul.required' => 'Posisi / Jabatan wajib diisi',
                'info1.required' => 'Nama Perusahaan wajib diisi',
                'tgl_mulai.required' => 'Tanggal mulai kerja wajib diisi',
                'isi.required' => 'Deskripsi pekerjaan wajib diisi',
            ]
        );

        $data = [
            'judul' => $request->judul,
            'tipe' => 'experience', 
            'info1' => $request->info1,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_akhir' => $request->tgl_akhir,
            'isi' => $request->isi
        ];

        riwayat::create($data);

        return redirect()->route('experience.index')->with('success', 'Berhasil menambahkan riwayat pengalaman baru');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // Pastikan data yang diedit memang bertipe experience untuk keamanan
        $data = riwayat::where('id', $id)->where('tipe', 'experience')->firstOrFail();
        return view('dashboard.experience.edit', compact('data'));
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
                'tgl_mulai' => 'required|date',
                'tgl_akhir' => 'nullable|date|after_or_equal:tgl_mulai',
                'isi' => 'required',
            ],
            [
                'judul.required' => 'Posisi / Jabatan wajib diisi',
                'info1.required' => 'Nama Perusahaan wajib diisi',
                'tgl_mulai.required' => 'Tanggal mulai kerja wajib diisi',
                'isi.required' => 'Deskripsi pekerjaan wajib diisi',
            ]
        );

        $data = [
            'judul' => $request->judul,
            'info1' => $request->info1,
            'tgl_mulai' => $request->tgl_mulai,
            'tgl_akhir' => $request->tgl_akhir,
            'isi' => $request->isi
        ];

        riwayat::where('id', $id)->where('tipe', 'experience')->update($data);

        return redirect()->route('experience.index')->with('success', 'Berhasil memperbarui data pengalaman kerja');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = riwayat::where('id', $id)->where('tipe', 'experience')->firstOrFail();
        $data->delete();

        return redirect()->route('experience.index')->with('success', 'Berhasil menghapus data pengalaman kerja');
    }
}