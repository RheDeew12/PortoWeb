@extends('dashboard.layout')

@section('konten')
    <div class="d-flex justify-content-between align-items-center mb-4 animate__animated animate__fadeIn">
        <div>
            <h4 class="fw-bold text-dark mb-1">Manajemen Portofolio Proyek</h4>
            <p class="text-muted small m-0">Kelola semua daftar proyek, aplikasi, dan sistem yang telah Anda kembangkan di sini.</p>
        </div>
        <a href="{{ route('project.create') }}" class="btn btn-primary rounded-pill px-3 fw-semibold d-inline-flex align-items-center gap-2 shadow-sm">
            <i class="mdi mdi-plus-circle-outline"></i> Tambah Proyek
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
                            <th style="width: 120px;">Gambar</th>
                            <th>Nama Proyek & Deskripsi</th>
                            <th>Teknologi / Tools</th>
                            <th>Tautan Tautan</th>
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
                                    @if($item->image)
                                        <img src="{{ asset('admin/images/projects/' . $item->image) }}" alt="{{ $item->title }}" class="rounded" style="width: 90px; height: 60px; object-fit: cover; border: 1px solid #e2e8f0;">
                                    @else
                                        <div class="bg-light rounded d-flex align-items-center justify-content-center text-muted border" style="width: 90px; height: 60px; font-size: 11px;">
                                            No Image
                                        </div>
                                    @endif
                                </td>
                                <td>
                                    <span class="fw-bold text-dark d-block mb-1">{{ $item->title }}</span>
                                    <span class="text-muted small d-block text-truncate" style="max-width: 300px;">
                                        {!! strip_tags($item->description) !!}
                                    </span>
                                </td>
                                <td>
                                    @if($item->tools)
                                        @foreach(explode(',', $item->tools) as $tool)
                                            <span class="badge bg-light-primary text-primary border border-primary border-opacity-25 rounded-pill px-2 py-1 mb-1" style="font-size: 11px;">
                                                {{ trim($tool) }}
                                            </span>
                                        @endforeach
                                    @else
                                        <span class="text-muted small italic">-</span>
                                    @endif
                                </td>
                                <td>
                                    <div class="d-flex flex-column gap-1">
                                        @if($item->link_github)
                                            <a href="{{ $item->link_github }}" target="_blank" class="text-decoration-none small text-dark d-inline-flex align-items-center gap-1">
                                                <i class="mdi mdi-github font-size-bold"></i> GitHub
                                            </a>
                                        @endif
                                        @if($item->link_live)
                                            <a href="{{ $item->link_live }}" target="_blank" class="text-decoration-none small text-indigo d-inline-flex align-items-center gap-1">
                                                <i class="mdi mdi-earth"></i> Live Demo
                                            </a>
                                        @endif
                                        @if(!$item->link_github && !$item->link_live)
                                            <span class="text-muted small italic">Internal Link</span>
                                        @endif
                                    </div>
                                </td>
                                <td class="text-center">
                                    <div class="d-flex justify-content-center gap-2">
                                        <a href="{{ route('project.edit', $item->id) }}" class="btn btn-sm btn-outline-warning rounded-pill px-3 fw-semibold d-inline-flex align-items-center gap-1">
                                            <i class="mdi mdi-pencil-outline"></i> Edit
                                        </a>
                                        
                                        <form action="{{ route('project.destroy', $item->id) }}" method="POST" onsubmit="return confirm('Apakah Anda yakin ingin menghapus data proyek ini?')">
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
                                    <i class="mdi mdi-folder-open-outline d-block mb-2 fs-3"></i>
                                    Belum ada data portofolio proyek tersedia.
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