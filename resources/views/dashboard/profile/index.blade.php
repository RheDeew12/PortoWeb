@extends('dashboard.layout')

@section('konten')
    <form action="{{ route('profile.update') }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        <div class="d-flex justify-content-between align-items-center mb-4 animate__animated animate__fadeIn">
            <div>
                <h4 class="fw-bold text-dark mb-1">Pengaturan Profil Portofolio</h4>
                <p class="text-muted small m-0">Kelola informasi data diri, foto profil resmi, dan kontak personal Anda yang akan tampil di halaman depan.</p>
            </div>
        </div>

        @if (Session::has('success'))
            <div class="alert alert-success alert-dismissible fade show mb-4 shadow-sm border-0" role="alert">
                <i class="mdi mdi-check-circle-outline me-2"></i> {{ Session::get('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger alert-dismissible fade show mb-4 border-0 shadow-sm" role="alert">
                <ul class="m-0 px-3">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="row g-4 animate__animated animate__fadeInUp mb-4">
            <div class="col-md-4">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                        <h5 class="fw-bold text-dark mb-1"><i class="mdi mdi-account-box-outline text-primary me-2"></i>Foto Profil</h5>
                        <p class="text-muted small">Gunakan foto formal terbaik Anda.</p>
                    </div>
                    <div class="card-body px-4 pb-4 text-center">
                        <div class="mb-4">
                            @if($foto && $foto->meta_value && file_exists(public_path('admin/images/profile/' . $foto->meta_value)))
                                <img src="{{ asset('admin/images/profile/' . $foto->meta_value) }}" 
                                     alt="Profile Portofolio" 
                                     class="img-thumbnail rounded-circle shadow-sm" 
                                     style="width: 150px; height: 150px; object-fit: cover; border: 4px solid #e2e8f0;">
                            @else
                                <img src="{{ asset('admin/images/faces/' . Auth::user()->avatar) }}" 
                                     alt="Profile Default" 
                                     class="img-thumbnail rounded-circle shadow-sm" 
                                     style="width: 150px; height: 150px; object-fit: cover; border: 4px solid #e2e8f0;">
                            @endif
                        </div>
                        <div class="mb-3 text-start">
                            <label for="_foto" class="form-label fw-semibold text-secondary small">Ganti Foto Portofolio</label>
                            <input type="file" class="form-control fs-6" name="_foto" id="_foto" accept="image/*">
                            <div class="form-text text-muted" style="font-size: 11px;">Format: JPG, JPEG, PNG. Maksimal 2MB.</div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-8">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                        <h5 class="fw-bold text-dark mb-1"><i class="mdi mdi-card-account-details-outline text-indigo me-2"></i>Informasi Pribadi</h5>
                        <p class="text-muted small">Data ini akan menjadi teks utama identitas diri Anda.</p>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="_nama" class="form-label fw-semibold text-secondary small">Nama Lengkap</label>
                                <input type="text" class="form-control form-control-lg fs-6 text-dark" name="_nama" id="_nama" placeholder="Contoh: Muhammad Rheza Dewangga" value="{{ old('_nama', $nama->meta_value ?? '') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="_gelar" class="form-label fw-semibold text-secondary small">Gelar / Profesi Singkat</label>
                                <input type="text" class="form-control form-control-lg fs-6 text-dark" name="_gelar" id="_gelar" placeholder="Contoh: Full Stack Web Developer / Programmer" value="{{ old('_gelar', $gelar->meta_value ?? '') }}" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="_email" class="form-label fw-semibold text-secondary small">Email Kontak</label>
                                <input type="email" class="form-control form-control-lg fs-6 text-dark" name="_email" id="_email" placeholder="Contoh: nama@gmail.com" value="{{ old('_email', $email->meta_value ?? '') }}" required>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="_telepon" class="form-label fw-semibold text-secondary small">Nomor Telepon / WhatsApp</label>
                                <input type="text" class="form-control form-control-lg fs-6 text-dark" name="_telepon" id="_telepon" placeholder="Contoh: 081234567890" value="{{ old('_telepon', $telepon->meta_value ?? '') }}">
                            </div>
                        </div>

                        <div class="mb-3">
                            <label for="_alamat" class="form-label fw-semibold text-secondary small">Alamat Tinggal Singkat</label>
                            <input type="text" class="form-control form-control-lg fs-6 text-dark" name="_alamat" id="_alamat" placeholder="Contoh: Yogyakarta, Indonesia" value="{{ old('_alamat', $alamat->meta_value ?? '') }}">
                        </div>

                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="_github" class="form-label fw-semibold text-secondary small">URL GitHub Profile</label>
                                <input type="url" class="form-control form-control-lg fs-6 text-dark" name="_github" id="_github" placeholder="https://github.com/username" value="{{ old('_github', $github->meta_value ?? '') }}">
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="_linkedin" class="form-label fw-semibold text-secondary small">URL LinkedIn Profile</label>
                                <input type="url" class="form-control form-control-lg fs-6 text-dark" name="_linkedin" id="_linkedin" placeholder="https://linkedin.com/in/username" value="{{ old('_linkedin', $linkedin->meta_value ?? '') }}">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end animate__animated animate__fadeInUp">
            <button class="btn btn-primary rounded-pill px-4 py-2 fw-semibold shadow-sm d-inline-flex align-items-center gap-2" type="submit">
                <i class="mdi mdi-content-save-outline"></i> SIMPAN PROFIL
            </button>
        </div>
    </form>
@endsection