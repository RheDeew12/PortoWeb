@extends('dashboard.layout')

@section('konten')
    <div class="d-flex justify-content-between align-items-center mb-4 animate__animated animate__fadeIn">
        <div>
            <h4 class="fw-bold text-dark mb-1">Manajemen Riwayat Sertifikasi</h4>
            <p class="text-muted small m-0">Kelola semua sertifikat kompetensi, lisensi, dan pencapaian profesional Anda di sini.</p>
        </div>
        <a href="{{ route('certification.create') }}" class="btn btn-primary rounded-pill px-3 fw-semibold d-inline-flex align-items-center gap-2 shadow-sm">
            <i class="mdi mdi-plus-circle-outline"></i> Tambah Sertifikasi
        </a>
    </div>

    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4 shadow-sm border-0" role="alert">
            <i class="mdi mdi-check-circle-outline me-2"></i> {{ Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0 animate__animated animate__fadeInUp">
        <div class="card-body p-0">
            <div class="table-responsive">
                <table class="table table-striped table-hover m-0 align-middle">
                    <thead class="table-light text-secondary small text-uppercase">
                        <tr>
                            <th class="text-center py-3" style="width: 80px;">No</th>
                            <th>Nama Sertifikasi & Penerbit</th>
                            <th>ID Kredensial</th>
                            <th>Tanggal Terbit</th>
                            <th>Berkas / Link</th>
                            <th class="text-center" style="width: 200px;">Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @php $i = 1; @endphp
                        @forelse ($data as $item)
                            <tr>
                                <td class="text-center fw-semibold text-muted">
                                    {{ method_exists($data, 'firstItem') ? $data->firstItem() + $loop->index : $i++ }}
                                </td>
                                <td>
                                    <span class="fw-bold text-dark d-block mb-1">{{ $item->name }}</span>
                                    <span class="text-muted small d-block"><i class="mdi mdi-domain me-1"></i>{{ $item->issuing_org }}</span>
                                </td>
                                <td>
                                    @if($item->credential_id)
                                        <code class="text-dark bg-light px-2 py-1 rounded small border">{{ $item->credential_id }}</code>
                                    @else
                                        <span class="text-muted small italic">-</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="text-secondary fw-medium">
                                        {{ \Carbon\Carbon::parse($item->issued_date)->isoFormat('DD MMMM Y') }}
                                    </span>
                                </td>
                                <td>
                                    <div class="d-flex flex-column gap-1">
                                        @if($item->file_cert)
                                            <a href="{{ asset('admin/images/certifications/' . $item->file_cert) }}" target="_blank" class="text-decoration-none small text-primary d-inline-flex align-items-center gap-1">
                                                <i class="mdi mdi-file-document-outline"></i> Lihat Dokumen
                                            </a>
                                        @endif
                                        @if($item->credential_url)
                                            <a href="{{ $item->credential_url }}" target="_blank" class="text-decoration-none small text-indigo d-inline-flex align-items-center gap-1">
                                                <i class="mdi mdi-link-variant"></i> Link Verifikasi
                                            </a>
                                        @endif
                                        @if(!$item->file_cert && !$item->credential_url)
                                            <span class="text-muted small italic">Tidak ada lampiran</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('certification.edit', $item->id) }}" class="btn btn-sm btn-outline-warning rounded-pill px-3 fw-semibold d-inline-flex align-items-center gap-1">
                                            <i class="mdi mdi-pencil-outline"></i> Edit
                                        </a>
                                        
                                        <form action="{{ route('certification.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus riwayat sertifikasi ini?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-sm btn-outline-danger rounded-pill px-3 fw-semibold d-inline-flex align-items-center gap-1">
                                                <i class="mdi mdi-trash-can-outline"></i> Hapus
                                            </button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                        @empty
                            <tr>
                                <td colspan="6" class="text-center py-5 text-muted">
                                    <i class="mdi mdi-certificate-outline d-block mb-2 fs-3"></i>
                                    Belum ada data riwayat sertifikasi tersedia.
                                </td>
                            </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    @if(method_exists($data, 'links'))
        <div class="d-flex justify-content-end mt-3">
            {{ $data->links() }}
        </div>
    @endif
@endsection