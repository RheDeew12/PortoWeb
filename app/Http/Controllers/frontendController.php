<?php

namespace App\Http\Controllers;

use App\Models\halaman;
use App\Models\metadata;
use App\Models\Project;
use App\Models\riwayat;
use App\Models\sertifikat;
use Illuminate\Http\Request;

class frontendController extends Controller
{
public function index() {
    // 1. Ambil Pengaturan Halaman Pilihan dari Admin (Page Setting)
    $aboutID = metadata::where('meta_key', '_halaman_about')->value('meta_value');
    $interestID = metadata::where('meta_key', '_halaman_interest')->value('meta_value');
    $awardID = metadata::where('meta_key', '_halaman_award')->value('meta_value');

    // 2. Ambil Konten Teks dari Pilihan Halaman tersebut
    $about_content = halaman::find($aboutID);
    $interest_content = halaman::find($interestID);
    $award_content = halaman::find($awardID);

    // 3. Ambil Biodata Utama Portofolio (Profile Setting & Interests Token)
    $profile = metadata::whereIn('meta_key', ['_nama', '_gelar', '_email', '_telepon', '_alamat', '_github', '_linkedin', '_foto'])
                        ->pluck('meta_value', 'meta_key');
    $interests_tags = metadata::where('meta_key', '_interest')->value('meta_value');

    // 4. Ambil List Data Jamak (Project, Sertifikat, Education)
    $projects = Project::orderBy('created_at', 'desc')->get();
    $certifications = sertifikat::orderBy('issued_date', 'desc')->get();
    $education = riwayat::where('tipe', 'education')->orderBy('tgl_mulai', 'desc')->get();
    $experience = riwayat::where('tipe', 'experience')->orderBy('tgl_mulai', 'desc')->get();

    return view('frontend.index', compact(
        'about_content', 'interest_content', 'award_content', 
        'profile', 'interests_tags', 'projects', 'certifications', 'education', 'experience'
    ));
}
}
