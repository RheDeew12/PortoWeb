@extends('dashboard.layout')

@section('konten')
    <form action="{{ route('interest.update') }}" method="POST">
        @csrf
        @method('PUT')

        <div class="d-flex justify-content-between align-items-center mb-4 animate__animated animate__fadeIn">
            <div>
                <h4 class="fw-bold text-dark mb-1">Pengaturan Minat & Keahlian</h4>
                <p class="text-muted small m-0">Kelola bidang spesialisasi, minat teknologi, atau keahlian utama yang ingin Anda tonjolkan.</p>
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

        <div class="card shadow-sm border-0 animate__animated animate__fadeInUp mb-4">
            <div class="card-header bg-white border-0 pt-4 px-4 pb-0">
                <h5 class="fw-bold text-dark mb-1">
                    <i class="mdi mdi-lightbulb-on-outline text-warning me-2"></i>Daftar Interests
                </h5>
                <p class="text-muted small">Inputkan keahlian atau minat Anda secara spesifik.</p>
            </div>
            <div class="card-body p-4 p-md-5">
                <div class="mb-3">
                    <label for="_interest" class="form-label fw-semibold text-secondary small">Minat / Bidang Keahlian Utama</label>
                    <input
                        type="text"
                        class="form-control form-control-lg fs-6 text-dark skill"
                        name="_interest" 
                        id="_interest"   
                        placeholder="Contoh: Web Development, Machine Learning, UI/UX Design"
                        value="{{ old('_interest', $interest->meta_value ?? '') }}" 
                    />
                    <div class="form-text text-muted" style="font-size: 11px;">
                        <i class="mdi mdi-information-outline me-1"></i>
                        Gunakan tanda koma (,) atau tekan tombol <strong>Enter</strong> untuk memisahkan setiap item minat/keahlian.
                    </div>
                </div>
            </div>
        </div>

        <div class="d-flex justify-content-end animate__animated animate__fadeInUp">
            <button class="btn btn-primary rounded-pill px-4 py-2 fw-semibold shadow-sm d-inline-flex align-items-center gap-2" type="submit">
                <i class="mdi mdi-content-save-outline"></i> SIMPAN INTERESTS
            </button>
        </div>
    </form>
@endsection

@push('scripts')
<script>
    $(document).ready(function() {
        $('.skill').tokenfield({
            autocomplete: {
                source: [{!! $skill !!}],
                delay: 100
            },
            showAutocompleteOnFocus: true
        });
    });
</script>
@endpush