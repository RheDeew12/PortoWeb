<?php

namespace App\Http\Controllers;

use App\Models\metadata;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;

class profileController extends Controller
{
    /**
     * Tampilkan halaman form pengaturan profil portofolio.
     */
    public function index()
    {
        // Mengambil data baris tunggal berdasarkan meta_key masing-masing
        $nama     = metadata::where('meta_key', '_nama')->first();
        $gelar    = metadata::where('meta_key', '_gelar')->first();
        $email    = metadata::where('meta_key', '_email')->first();
        $telepon  = metadata::where('meta_key', '_telepon')->first();
        $alamat   = metadata::where('meta_key', '_alamat')->first();
        $github   = metadata::where('meta_key', '_github')->first();
        $linkedin = metadata::where('meta_key', '_linkedin')->first();
        $foto     = metadata::where('meta_key', '_foto')->first();

        return view('dashboard.profile.index', compact(
            'nama', 'gelar', 'email', 'telepon', 'alamat', 'github', 'linkedin', 'foto'
        ));
    }

    /**
     * Perbarui atau buat baru data profil portofolio ke tabel metadata.
     */
    public function update(Request $request)
    {
        // 1. Validasi Input Form
        $request->validate([
            '_nama'     => 'required|string|max:255',
            '_gelar'    => 'required|string|max:255',
            '_email'    => 'required|email|max:255',
            '_foto'     => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            '_github'   => 'nullable|url',
            '_linkedin' => 'nullable|url',
        ], [
            '_nama.required'  => 'Nama lengkap wajib diisi!',
            '_gelar.required' => 'Gelar atau profesi singkat wajib diisi!',
            '_email.required' => 'Email kontak wajib diisi!',
            '_email.email'    => 'Format alamat email tidak valid!',
            '_foto.image'     => 'Berkas yang diunggah wajib berupa gambar!',
            '_foto.max'       => 'Ukuran foto maksimal adalah 2MB!',
            '_github.url'     => 'Format URL GitHub tidak valid!',
            '_linkedin.url'   => 'Format URL LinkedIn tidak valid!',
        ]);

        // 2. Simpan Data Teks Menggunakan updateOrCreate
        metadata::updateOrCreate(['meta_key' => '_nama'], ['meta_value' => $request->_nama]);
        metadata::updateOrCreate(['meta_key' => '_gelar'], ['meta_value' => $request->_gelar]);
        metadata::updateOrCreate(['meta_key' => '_email'], ['meta_value' => $request->_email]);
        metadata::updateOrCreate(['meta_key' => '_telepon'], ['meta_value' => $request->_telepon]);
        metadata::updateOrCreate(['meta_key' => '_alamat'], ['meta_value' => $request->_alamat]);
        metadata::updateOrCreate(['meta_key' => '_github'], ['meta_value' => $request->_github]);
        metadata::updateOrCreate(['meta_key' => '_linkedin'], ['meta_value' => $request->_linkedin]);

        // 3. Penanganan Upload File Foto Profil Resmi
        if ($request->hasFile('_foto')) {
            // Ambil data foto lama dari database
            $fotoLama = metadata::where('meta_key', '_foto')->first();
            
            // Hapus berkas foto lama di server jika ada
            if ($fotoLama && $fotoLama->meta_value && File::exists(public_path('admin/images/profile/' . $fotoLama->meta_value))) {
                File::delete(public_path('admin/images/profile/' . $fotoLama->meta_value));
            }

            // Proses upload berkas foto baru
            $file = $request->file('_foto');
            $foto_nama = time() . "_" . $file->getClientOriginalName();
            
            // Pastikan folder public/admin/images/profile ada
            $destinationPath = public_path('admin/images/profile');
            if (!File::exists($destinationPath)) {
                File::makeDirectory($destinationPath, 0755, true, true);
            }

            $file->move($destinationPath, $foto_nama);

            // Simpan nama file baru ke tabel metadata
            metadata::updateOrCreate(['meta_key' => '_foto'], ['meta_value' => $foto_nama]);
        }

        return redirect()->route('profile.index')->with('success', 'Berhasil memperbarui data profil portofolio Anda.');
    }
}