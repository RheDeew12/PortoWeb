<?php

namespace App\Http\Controllers;

use App\Models\sertifikat; // Menggunakan model ini secara konsisten
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class certificationController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Mengambil semua data sertifikasi urut dari yang terbaru
        $data = sertifikat::orderBy('issued_date', 'desc')->get();
        return view('dashboard.certification.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('dashboard.certification.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name'         => 'required|string|max:255',
            'issuing_org'  => 'required|string|max:255',
            'issued_date'  => 'required|date',
            'file_cert'    => 'nullable|mimes:pdf,jpeg,png,jpg|max:2048', // Maksimal 2MB
        ], [
            'name.required'        => 'Nama sertifikasi wajib diisi!',
            'issuing_org.required' => 'Organisasi penerbit wajib diisi!',
            'issued_date.required' => 'Tanggal terbit wajib diisi!',
            'file_cert.mimes'      => 'Berkas sertifikat harus berupa PDF, JPEG, JPG, atau PNG!',
            'file_cert.max'        => 'Ukuran berkas maksimal adalah 2MB!',
        ]);

        $data = [
            'name'         => $request->name,
            'issuing_org'  => $request->issuing_org,
            'issued_date'  => $request->issued_date,
            'credential_id'=> $request->credential_id,
            'credential_url'=> $request->credential_url,
            'description'  => $request->description,
        ];

        // Proses unggah berkas sertifikat jika ada
        if ($request->hasFile('file_cert')) {
            $file = $request->file('file_cert');
            $file_name = time() . "_" . $file->getClientOriginalName();
            
            // Simpan ke folder public/admin/images/certifications
            $destinationPath = public_path('admin/images/certifications');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }
            $file->move($destinationPath, $file_name);
            
            $data['file_cert'] = $file_name;
        }

        sertifikat::create($data);

        return redirect()->route('certification.index')->with('success', 'Berhasil menambahkan data sertifikasi baru.');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        return redirect()->route('certification.index');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $certification = sertifikat::findOrFail($id);
        return view('dashboard.certification.edit', compact('certification'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // PERBAIKAN: Mengubah Certification menjadi model sertifikat
        $certification = sertifikat::findOrFail($id);

        $request->validate([
            'name'         => 'required|string|max:255',
            'issuing_org'  => 'required|string|max:255',
            'issued_date'  => 'required|date',
            'file_cert'    => 'nullable|mimes:pdf,jpeg,png,jpg|max:2048',
        ], [
            'name.required'        => 'Nama sertifikasi wajib diisi!',
            'issuing_org.required' => 'Organisasi penerbit wajib diisi!',
            'issued_date.required' => 'Tanggal terbit wajib diisi!',
            'file_cert.mimes'      => 'Berkas sertifikat harus berupa PDF, JPEG, JPG, atau PNG!',
            'file_cert.max'        => 'Ukuran berkas maksimal adalah 2MB!',
        ]);

        $data = [
            'name'         => $request->name,
            'issuing_org'  => $request->issuing_org,
            'issued_date'  => $request->issued_date,
            'credential_id'=> $request->credential_id,
            'credential_url'=> $request->credential_url,
            'description'  => $request->description,
        ];

        if ($request->hasFile('file_cert')) {
            // Hapus berkas lama jika ada berkas baru yang diunggah
            if ($certification->file_cert && File::exists(public_path('admin/images/certifications/' . $certification->file_cert))) {
                File::delete(public_path('admin/images/certifications/' . $certification->file_cert));
            }

            $file = $request->file('file_cert');
            $file_name = time() . "_" . $file->getClientOriginalName();
            $destinationPath = public_path('admin/images/certifications');
            $file->move($destinationPath, $file_name);
            
            $data['file_cert'] = $file_name;
        }

        $certification->update($data);

        return redirect()->route('certification.index')->with('success', 'Berhasil memperbarui data sertifikasi.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // PERBAIKAN: Mengubah Certification menjadi model sertifikat
        $certification = sertifikat::findOrFail($id);

        // Hapus file fisik dari server sebelum menghapus datanya di database
        if ($certification->file_cert && File::exists(public_path('admin/images/certifications/' . $certification->file_cert))) {
            File::delete(public_path('admin/images/certifications/' . $certification->file_cert));
        }

        $certification->delete();

        return redirect()->route('certification.index')->with('success', 'Berhasil menghapus data sertifikasi.');
    }
}