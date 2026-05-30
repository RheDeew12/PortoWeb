@extends('dashboard.layout')

@section('konten')
    <div class="pb-4 animate__animated animate__fadeIn">
        <a href="{{ route('project.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3 fw-semibold d-inline-flex align-items-center gap-2">
            <i class="mdi mdi-arrow-left"></i> Kembali
        </a>
    </div>
    
    <div class="card shadow-sm border-0 animate__animated animate__fadeInUp">
        <div class="card-body p-4 p-md-5">
            <div class="mb-4">
                <h4 class="fw-bold text-dark mb-1">Edit Portofolio Proyek</h4>
                <p class="text-muted small">Silakan perbarui formulir di bawah ini untuk mengubah data atau berkas portofolio proyek Anda.</p>
            </div>

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

            <form action="{{ route('project.update', $project->id) }}" method="POST" enctype="multipart/form-data">
                @csrf 
                @method('PUT')
                
                <div class="mb-4">
                    <label for="title" class="form-label fw-semibold text-secondary small">Nama / Judul Proyek</label>
                    <input
                        type="text"
                        class="form-control form-control-lg fs-6 text-dark"
                        name="title" 
                        id="title"   
                        placeholder="Contoh: Aplikasi Sistem Informasi Manajemen Laboratorium (Mainten-Lab)"
                        value="{{ old('title', $project->title) }}" 
                        required
                    />
                </div>

                <div class="mb-4">
                    <label for="tools" class="form-label fw-semibold text-secondary small">Teknologi / Tools yang Digunakan</label>
                    <input
                        type="text"
                        class="form-control form-control-lg fs-6 text-dark skill"
                        name="tools" 
                        id="tools"   
                        placeholder="Contoh: PHP, Laravel, MySQL, Bootstrap"
                        value="{{ old('tools', $project->tools) }}" 
                    />
                    <div class="form-text text-muted" style="font-size: 11px;">Gunakan tanda koma (,) atau tekan enter untuk memisahkan setiap teknologi.</div>
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label for="link_github" class="form-label fw-semibold text-secondary small">Tautan Repositori GitHub</label>
                        <input
                            type="url"
                            class="form-control form-control-lg fs-6 text-dark"
                            name="link_github" 
                            id="link_github"   
                            placeholder="Contoh: https://github.com/username/project-name"
                            value="{{ old('link_github', $project->link_github) }}" 
                        />
                    </div>
                    
                    <div class="col-md-6">
                        <label for="link_live" class="form-label fw-semibold text-secondary small">Tautan Live Demo / Tautan Aplikasi</label>
                        <input
                            type="url"
                            class="form-control form-control-lg fs-6 text-dark"
                            name="link_live" 
                            id="link_live"   
                            placeholder="Contoh: https://nama-aplikasi.com atau https://play.google.com/..."
                            value="{{ old('link_live', $project->link_live) }}" 
                        />
                    </div>
                </div>

                <div class="mb-4">
                    <label for="image" class="form-label fw-semibold text-secondary small">Screenshot / Gambar Proyek</label>
                    
                    @if($project->image)
                        <div class="mb-3">
                            <p class="text-muted small mb-1">Gambar saat ini:</p>
                            <img src="{{ asset('admin/images/projects/' . $project->image) }}" alt="Preview" class="img-thumbnail rounded shadow-sm" style="max-width: 200px; max-height: 130px; object-fit: cover;">
                        </div>
                    @endif

                    <input
                        type="file"
                        class="form-control form-control-lg fs-6"
                        name="image" 
                        id="image"   
                        accept="image/*"
                    />
                    <div class="form-text text-muted" style="font-size: 11px;">Pilih file baru jika ingin mengganti gambar saat ini. Format: JPG, JPEG, PNG (Maks. 2MB).</div>
                </div>
                
                <div class="mb-4">
                    <label for="description" class="form-label fw-semibold text-secondary small">Deskripsi Proyek</label>
                    <textarea 
                        class="form-control summernote" 
                        name="description" 
                        id="description" 
                        rows="8" 
                        placeholder="Tuliskan latar belakang pembuatan proyek, fitur-fitur utama sistem, atau peran Anda dalam pengembangan proyek ini...">{{ old('description', $project->description) }}</textarea>
                </div>
                
                <div class="pt-2 d-flex justify-content-end gap-2">
                    <button class="btn btn-primary rounded-pill px-4 fw-semibold d-inline-flex align-items-center gap-2 shadow-sm" type="submit">
                        <i class="mdi mdi-content-save-outline"></i> PERBARUI PROYEK
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection