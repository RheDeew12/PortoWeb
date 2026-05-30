@extends('dashboard.layout')

@section('konten')
    <div class="pb-4 animate__animated animate__fadeIn">
        <a href="{{ route('experience.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3 fw-semibold d-inline-flex align-items-center gap-2">
            <i class="mdi mdi-arrow-left"></i> Kembali
        </a>
    </div>
    
    <div class="card shadow-sm border-0 animate__animated animate__fadeInUp">
        <div class="card-body p-4 p-md-5">
            <div class="mb-4">
                <h4 class="fw-bold text-dark mb-1">Tambah Pengalaman Kerja</h4>
                <p class="text-muted small">Silakan isi formulir di bawah ini untuk menambahkan riwayat pengalaman profesional baru Anda.</p>
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

            <form action="{{ route('experience.store') }}" method="POST">
                @csrf 
                
                <div class="mb-4">
                    <label for="judul" class="form-label fw-semibold text-secondary small">Posisi / Jabatan</label>
                    <input
                        type="text"
                        class="form-control form-control-lg fs-6"
                        name="judul" 
                        id="judul"   
                        placeholder="Contoh: Pelaksana Pranata Komputer (Programmer)"
                        value="{{ old('judul') }}" 
                        required
                    />
                </div>

                <div class="mb-4">
                    <label for="info1" class="form-label fw-semibold text-secondary small">Nama Perusahaan / Institusi</label>
                    <input
                        type="text"
                        class="form-control form-control-lg fs-6"
                        name="info1" 
                        id="info1"   
                        placeholder="Contoh: Politeknik ATK Yogyakarta"
                        value="{{ old('info1') }}" 
                        required
                    />
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label for="tgl_mulai" class="form-label fw-semibold text-secondary small">Tanggal Mulai Kerja</label>
                        <input
                            type="date"
                            class="form-control form-control-lg fs-6"
                            name="tgl_mulai" 
                            id="tgl_mulai"   
                            value="{{ old('tgl_mulai') }}" 
                            required
                        />
                    </div>
                    <div class="col-md-6">
                        <label for="tgl_akhir" class="form-label fw-semibold text-secondary small">Tanggal Selesai Kerja</label>
                        <input
                            type="date"
                            class="form-control form-control-lg fs-6"
                            name="tgl_akhir" 
                            id="tgl_akhir"   
                            value="{{ old('tgl_akhir') }}"
                        />
                        <div class="form-text text-muted" style="font-size: 11px;">Kosongkan jika Anda masih aktif bekerja di posisi ini saat ini.</div>
                    </div>
                </div>
                
                <div class="mb-4">
                    <label for="Isi" class="form-label fw-semibold text-secondary small">Deskripsi Pekerjaan / Tugas</label>
                    <textarea 
                        class="form-control summernote" 
                        name="isi" 
                        id="Isi" 
                        rows="8" 
                        placeholder="Ceritakan ruang lingkup pekerjaan, teknologi yang digunakan, atau pencapaian Anda..."
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