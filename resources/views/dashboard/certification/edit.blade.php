@extends('dashboard.layout')

@section('konten')
    <div class="pb-4 animate__animated animate__fadeIn">
        <a href="{{ route('certification.index') }}" class="btn btn-sm btn-outline-secondary rounded-pill px-3 fw-semibold d-inline-flex align-items-center gap-2">
            <i class="mdi mdi-arrow-left"></i> Kembali
        </a>
    </div>
    
    <div class="card shadow-sm border-0 animate__animated animate__fadeInUp">
        <div class="card-body p-4 p-md-5">
            <div class="mb-4">
                <h4 class="fw-bold text-dark mb-1">Edit Riwayat Sertifikasi</h4>
                <p class="text-muted small">Silakan perbarui formulir di bawah ini untuk mengubah data atau berkas pencapaian sertifikasi Anda.</p>
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

            <form action="{{ route('certification.update', $certification->id) }}" method="POST" enctype="multipart/form-data">
                @csrf 
                @method('PUT')
                
                <div class="mb-4">
                    <label for="name" class="form-label fw-semibold text-secondary small">Nama Sertifikasi / Lisensi</label>
                    <input
                        type="text"
                        class="form-control form-control-lg fs-6 text-dark"
                        name="name" 
                        id="name"   
                        placeholder="Contoh: Cisco Certified Network Associate (CCNA)"
                        value="{{ old('name', $certification->name) }}" 
                        required
                    />
                </div>

                <div class="mb-4">
                    <label for="issuing_org" class="form-label fw-semibold text-secondary small">Organisasi / Lembaga Penerbit</label>
                    <input
                        type="text"
                        class="form-control form-control-lg fs-6 text-dark"
                        name="issuing_org" 
                        id="issuing_org"   
                        placeholder="Contoh: Cisco / BNSP / Dicoding Indonesia"
                        value="{{ old('issuing_org', $certification->issuing_org) }}" 
                        required
                    />
                </div>

                <div class="row mb-4">
                    <div class="col-md-6 mb-3 mb-md-0">
                        <label for="credential_id" class="form-label fw-semibold text-secondary small">ID Kredensial (No. Sertifikat)</label>
                        <input
                            type="text"
                            class="form-control form-control-lg fs-6 text-dark"
                            name="credential_id" 
                            id="credential_id"   
                            placeholder="Contoh: CERT-12345678"
                            value="{{ old('credential_id', $certification->credential_id) }}" 
                        />
                    </div>
                    
                    <div class="col-md-6">
                        <label for="issued_date" class="form-label fw-semibold text-secondary small">Tanggal Terbit</label>
                        <input
                            type="date"
                            class="form-control form-control-lg fs-6 text-dark"
                            name="issued_date" 
                            id="issued_date"   
                            value="{{ old('issued_date', \Carbon\Carbon::parse($certification->issued_date)->format('Y-m-2D') ? $certification->issued_date->format('Y-m-d') : '') }}" 
                            required
                        />
                    </div>
                </div>

                <div class="mb-4">
                    <label for="credential_url" class="form-label fw-semibold text-secondary small">URL Kredensial (Link Verifikasi Online)</label>
                    <input
                        type="url"
                        class="form-control form-control-lg fs-6 text-dark"
                        name="credential_url" 
                        id="credential_url"   
                        placeholder="Contoh: https://verification.com/verify/id-sertifikat"
                        value="{{ old('credential_url', $certification->credential_url) }}" 
                    />
                </div>

                <div class="mb-4">
                    <label for="file_cert" class="form-label fw-semibold text-secondary small">Berkas Sertifikat</label>
                    
                    @if($certification->file_cert)
                        <div class="mb-3">
                            <p class="text-muted small mb-1">Lampiran saat ini:</p>
                            <a href="{{ asset('admin/images/certifications/' . $certification->file_cert) }}" target="_blank" class="btn btn-xs btn-outline-primary px-3 py-1 rounded d-inline-flex align-items-center gap-1 small text-decoration-none">
                                <i class="mdi mdi-file-document-outline"></i> Lihat Dokumen Tersimpan
                            </a>
                        </div>
                    @endif

                    <input
                        type="file"
                        class="form-control form-control-lg fs-6"
                        name="file_cert" 
                        id="file_cert"   
                        accept="image/*,.pdf"
                    />
                    <div class="form-text text-muted" style="font-size: 11px;">Pilih file baru jika ingin mengganti berkas lampiran. Format: PDF, JPG, JPEG, PNG (Maks. 2MB).</div>
                </div>
                
                <div class="mb-4">
                    <label for="description" class="form-label fw-semibold text-secondary small">Keterangan / Deskripsi Kompetensi</label>
                    <textarea 
                        class="form-control summernote" 
                        name="description" 
                        id="description" 
                        rows="8" 
                        placeholder="Tuliskan ringkasan materi, silabus keahlian, atau kompetensi utama yang divalidasi melalui sertifikat ini...">{{ old('description', $certification->description) }}</textarea>
                </div>
                
                <div class="pt-2 d-flex justify-content-end gap-2">
                    <button class="btn btn-primary rounded-pill px-4 fw-semibold d-inline-flex align-items-center gap-2 shadow-sm" type="submit">
                        <i class="mdi mdi-content-save-outline"></i> PERBARUI SERTIFIKAT
                    </button>
                </div>
            </form>
        </div>
    </div>
@endsection