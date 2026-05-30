<?php

namespace App\Http\Controllers;

use App\Models\halaman;
use Illuminate\Http\Request;

class halamanController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // PERBAIKAN: Ambil data dari database dan urutkan dari yang terbaru
        // Anda bisa gunakan halaman::all() atau halaman::orderBy('id', 'desc')->get();
        // Di sini saya gunakan paginate jika ke depan datanya banyak
        $data = halaman::orderBy('judul', 'asc')->paginate(10);
        
        return view('dashboard.halaman.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.halaman.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // PERBAIKAN: Menyamakan key sesuai input form (case-sensitive)
        // Pastikan di file create.blade.php bagian input judul diubah menjadi name="judul" (huruf kecil)
        $request->validate(
            [
                'judul' => 'required',
                'isi' => 'required',
            ],
            [
                'judul.required' => 'Judul Wajib Diisi',
                'isi.required' => 'Isi Halaman Wajib Diisi'
            ]
        );

        $data = [
            'judul' => $request->judul,
            'isi' => $request->isi
        ];
        
        halaman::create($data);

        // PERBAIKAN: Tambahkan redirect setelah berhasil simpan data
        return redirect()->route('halaman.index')->with('success', 'Berhasil menambahkan data halaman baru');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        // Biasanya dikosongkan jika tidak digunakan
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        // LENGKAPI: Ambil data berdasarkan ID untuk dikirim ke form edit
        $data = halaman::findOrFail($id);
        return view('dashboard.halaman.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // LENGKAPI: Proses validasi dan update data ke database
        $request->validate(
            [
                'judul' => 'required',
                'isi' => 'required',
            ],
            [
                'judul.required' => 'Judul Wajib Diisi',
                'isi.required' => 'Isi Halaman Wajib Diisi'
            ]
        );

        $data = [
            'judul' => $request->judul,
            'isi' => $request->isi
        ];

        halaman::where('id', $id)->update($data);

        return redirect()->route('halaman.index')->with('success', 'Berhasil memperbarui data halaman');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // LENGKAPI: Proses hapus data berdasarkan ID
        $data = halaman::findOrFail($id);
        $data->delete();

        return redirect()->route('halaman.index')->with('success', 'Berhasil menghapus data halaman');
    }
}