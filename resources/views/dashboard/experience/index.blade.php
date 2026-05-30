@extends('dashboard.layout')

@section('konten')
    <div class="d-flex justify-content-between align-items-center mb-4 animate__animated animate__fadeIn">
        <div>
            <h4 class="fw-bold text-dark mb-1">Manajemen Pengalaman Kerja</h4>
            <p class="text-muted small m-0">Kelola semua riwayat pekerjaan dan pengalaman profesional Anda di sini.</p>
        </div>
        <a href="{{ route('experience.create') }}" class="btn btn-primary rounded-pill px-3 fw-semibold d-inline-flex align-items-center gap-2 shadow-sm">
            <i class="mdi mdi-plus-circle-outline"></i> Tambah Pengalaman
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
                            <th>Posisi / Jabatan</th>
                            <th>Perusahaan / Institusi</th>
                            <th>Periode Kerja</th>
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
                                    <span class="fw-bold text-dark">{{ $item->judul }}</span>
                                </td>
                                <td>
                                    <span class="text-secondary fw-medium">{{ $item->info1 }}</span>
                                </td>
                                <td>
                                    <span class="text-muted small">
                                        {{ \Carbon\Carbon::parse($item->tgl_mulai)->isoFormat('D MMMM Y') }} 
                                        s.d. 
                                        @if ($item->tgl_akhir)
                                            {{ \Carbon\Carbon::parse($item->tgl_akhir)->isoFormat('D MMMM Y') }}
                                        @else
                                            <span class="badge bg-light-success text-success border border-success border-opacity-25 rounded-pill px-2 py-1">Saat Ini</span>
                                        @endif
                                    </span>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('experience.edit', $item->id) }}" class="btn btn-sm btn-outline-warning rounded-pill px-3 fw-semibold d-inline-flex align-items-center gap-1">
                                            <i class="mdi mdi-pencil-outline"></i> Edit
                                        </a>
                                        
                                        <form action="{{ route('experience.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus riwayat pengalaman ini?')">
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
                                <td colspan="5" class="text-center py-5 text-muted">
                                    <i class="mdi mdi-folder-open-outline d-block mb-2 fs-3"></i>
                                    Belum ada data pengalaman kerja tersedia.
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