@extends('dashboard.layout')

@section('konten')
    <form action="{{ route('skill.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="d-flex justify-content-between align-items-center mb-4 animate__animated animate__fadeIn">
            <div>
                <h4 class="fw-bold text-dark mb-1">Manajemen Keahlian (Skills)</h4>
                <p class="text-muted small m-0">Kelola daftar bahasa pemrograman, tools, dan alur kerja (workflow) Anda secara langsung di sini.</p>
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
            <div class="col-md-5">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                        <h5 class="fw-bold text-dark mb-1"><i class="mdi mdi-code-tags text-primary me-2"></i>Languages & Tools</h5>
                        <p class="text-muted small">Ketik keahlian Anda, lalu tekan Koma (,) atau Enter untuk membuat tag.</p>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="mb-3">
                            <label for="_language" class="form-label fw-semibold text-secondary small">Daftar Bahasa / Tools</label>
                            
                            <input 
                                type="text" 
                                class="form-control form-control-lg fs-6 text-dark skill" 
                                name="_language" 
                                id="_language" 
                                value="{{ get_meta_value('_language') }}"
                                placeholder="Contoh: PHP, Laravel, MySQL..."
                                required
                            />
                            
                            <div class="form-text text-muted" style="font-size: 11px;">
                                *Rekomendasi otomatis (autocomplete) diambil langsung dari berkas devicon.json saat Anda mengetik.
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-md-7">
                <div class="card shadow-sm border-0 h-100">
                    <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                        <h5 class="fw-bold text-dark mb-1"><i class="mdi mdi-sitemap text-indigo me-2"></i>Workflow</h5>
                        <p class="text-muted small">Gunakan editor di bawah untuk menyusun alur kerja atau metodologi Anda.</p>
                    </div>
                    <div class="card-body px-4 pb-4">
                        <div class="mb-3">
                            <label for="_workflow" class="form-label fw-semibold text-secondary small">Deskripsi Alur Kerja</label>
                            <textarea 
                                class="form-control summernote" 
                                name="_workflow" 
                                id="_workflow" 
                                rows="8" 
                                placeholder="Tuliskan poin-poin alur kerja pengembangan sistem Anda di sini...">{{ get_meta_value('_workflow') }}</textarea>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end animate__animated animate__fadeInUp">
            <button class="btn btn-primary rounded-pill px-4 py-2 fw-semibold shadow-sm d-inline-flex align-items-center gap-2" type="submit">
                <i class="mdi mdi-content-save-outline"></i> SIMPAN PERUBAHAN
            </button>
        </div>
    </form>
@endsection