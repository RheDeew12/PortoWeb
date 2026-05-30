@extends('dashboard.layout')

@section('konten')
    <div class="d-flex justify-content-between align-items-center mb-4 animate__animated animate__fadeIn">
        <div>
            <h4 class="fw-bold text-dark mb-1">Pengaturan Komponen Halaman</h4>
            <p class="text-muted small m-0">Tentukan rujukan data atau halaman yang akan ditampilkan pada setiap bagian *front-end* portofolio Anda.</p>
        </div>
    </div>

    @if (Session::has('success'))
        <div class="alert alert-success alert-dismissible fade show mb-4 shadow-sm border-0" role="alert">
            <i class="mdi mdi-check-circle-outline me-2"></i> {{ Session::get('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="card shadow-sm border-0 animate__animated animate__fadeInUp">
        <div class="card-body p-4 p-md-5">
            
            <form action="{{ route('pengaturanhalaman.update') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="row mb-4 align-items-center">
                    <div class="col-md-3">
                        <label for="_halaman_about" class="form-label fw-bold text-dark m-0">About</label>
                    </div>
                    <div class="col-md-9">
                        <select class="form-select form-select-lg fs-6 text-dark" name="_halaman_about" id="_halaman_about">
                            <option value="">-pilih-</option>
                            @foreach ($daftar_halaman as $item)
                                <option value="{{ $item->id }}" {{ isset($set_about->meta_value) && $set_about->meta_value == $item->id ? 'selected' : '' }}>
                                    {{ $item->judul }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-4 align-items-center">
                    <div class="col-md-3">
                        <label for="_halaman_interest" class="form-label fw-bold text-dark m-0">Interest</label>
                    </div>
                    <div class="col-md-9">
                        <select class="form-select form-select-lg fs-6 text-dark" name="_halaman_interest" id="_halaman_interest">
                            <option value="">-pilih-</option>
                            @foreach ($daftar_halaman as $item)
                                <option value="{{ $item->id }}" {{ isset($set_interest->meta_value) && $set_interest->meta_value == $item->id ? 'selected' : '' }}>
                                    {{ $item->judul }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="row mb-4 align-items-center">
                    <div class="col-md-3">
                        <label for="_halaman_award" class="form-label fw-bold text-dark m-0">Award</label>
                    </div>
                    <div class="col-md-9">
                        <select class="form-select form-select-lg fs-6 text-dark" name="_halaman_award" id="_halaman_award">
                            <option value="">-pilih-</option>
                            @foreach ($daftar_halaman as $item)
                                <option value="{{ $item->id }}" {{ isset($set_award->meta_value) && $set_award->meta_value == $item->id ? 'selected' : '' }}>
                                    {{ $item->judul }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                </div>

                <div class="pt-3 row">
                    <div class="col-md-9 offset-md-3">
                        <button class="btn btn-primary rounded px-4 py-2 fw-semibold shadow-sm text-uppercase" type="submit">
                            Simpan
                        </button>
                    </div>
                </div>

            </form>
        </div>
    </div>
@endsection