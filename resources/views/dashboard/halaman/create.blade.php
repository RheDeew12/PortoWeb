@extends('dashboard.layout')

@section('konten')
    <div class="pb-4 animate__animated animate__fadeIn">
        <a href="{{ route('halaman.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3 fw-semibold d-inline-flex align-items-center gap-2">
            <i class="mdi mdi-arrow-left"></i> Kembali
        </a>
    </div>
    
    <div class="card shadow-sm border-0 animate__animated animate__fadeInUp">
        <div class="card-body p-4 p-md-5">
            <div class="mb-4">
                <h4 class="fw-bold text-dark mb-1">Tambah Halaman Baru</h4>
                <p class="text-muted small">Silakan isi formulir di bawah ini untuk membuat konten halaman portofolio baru.</p>
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

            <form action="{{ route('halaman.store') }}" method="POST">
                @csrf 
                
                <div class="mb-4">
                    <label for="judul" class="form-label fw-semibold text-secondary small">Judul Halaman</label>
                    <input
                        type="text"
                        class="form-control form-control-lg fs-6"
                        name="judul" id="judul"   placeholder="Masukkan judul halaman..."
                        value="{{ old('judul') }}" required
                    />
                </div>
                
                <div class="mb-4">
                    <label for="Isi" class="form-label fw-semibold text-secondary small">Isi Konten</label>
                    <textarea 
                        class="form-control summernote" 
                        name="isi" 
                        id="Isi" 
                        rows="8" 
                        placeholder="Tuliskan isi konten halaman di sini..."
                        required>{{ old('isi') }}</textarea>
                </div>
                
                <div class="pt-2 d-flex justify-content-end gap-2">
                    <button class="btn btn-primary rounded-pill px-4 fw-semibold" name="simpan" type="submit">
                        <i class="mdi mdi-content-save-outline me-1"></i> SIMPAN
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection