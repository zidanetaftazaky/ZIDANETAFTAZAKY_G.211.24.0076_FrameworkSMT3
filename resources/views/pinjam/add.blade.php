@extends('layouts.app')

@section('title', 'Tambah Peminjaman - Aplikasi Perpustakaan')
@section('page-title', 'Tambah Peminjaman')

@section('content')
<div class="page-header">
    <h1><i class="bi bi-plus-circle me-2"></i>Tambah Peminjaman Buku</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('perpus') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('pinjam') }}">Daftar Peminjaman</a></li>
            <li class="breadcrumb-item active">Tambah Peminjaman</li>
        </ol>
    </nav>
</div>

<div class="card-modern">
    <div class="card-header-modern">
        <i class="bi bi-journal-plus me-2"></i>Form Peminjaman Buku
    </div>
    <div class="card-body-modern">
        @if($errors->any())
            <div class="alert alert-danger">
                <i class="bi bi-exclamation-triangle-fill me-2"></i>
                <strong>Terjadi kesalahan:</strong>
                <ul class="mb-0 mt-2">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ url('pinjam/save') }}" method="POST">
            @csrf

            <div class="row g-3">
                <div class="col-md-12">
                    <label for="ID_Anggota" class="form-label">
                        <i class="bi bi-person me-1"></i>Anggota <span class="text-danger">*</span>
                    </label>
                    <select name="ID_Anggota" id="ID_Anggota" class="form-select" required>
                        <option value="">-- Pilih Anggota --</option>
                        @foreach($optanggota as $key => $value)
                            <option value="{{ $key }}" {{ old('ID_Anggota') == $key ? 'selected' : '' }}>
                                {{ $value }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-12">
                    <label for="ID_Buku" class="form-label">
                        <i class="bi bi-book me-1"></i>Buku <span class="text-danger">*</span>
                    </label>
                    <select name="ID_Buku" id="ID_Buku" class="form-select" required>
                        <option value="">-- Pilih Buku --</option>
                        @foreach($optbuku as $key => $value)
                            <option value="{{ $key }}" {{ old('ID_Buku') == $key ? 'selected' : '' }}>
                                {{ $value }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-md-6">
                    <label for="tgl_pinjam" class="form-label">
                        <i class="bi bi-calendar-event me-1"></i>Tanggal Pinjam <span class="text-danger">*</span>
                    </label>
                    <input type="date" 
                           name="tgl_pinjam" 
                           id="tgl_pinjam" 
                           class="form-control"
                           value="{{ old('tgl_pinjam') }}" 
                           required>
                </div>

                <div class="col-md-6">
                    <label for="tgl_kembali" class="form-label">
                        <i class="bi bi-calendar-check me-1"></i>Tanggal Kembali <span class="text-danger">*</span>
                    </label>
                    <input type="date" 
                           name="tgl_kembali" 
                           id="tgl_kembali" 
                           class="form-control"
                           value="{{ old('tgl_kembali') }}" 
                           required>
                </div>

                <div class="col-12 mt-4">
                    <div class="d-flex justify-content-between">
                        <button type="submit" name="btn_simpan" class="btn btn-success-modern">
                            <i class="bi bi-check-circle me-2"></i>Simpan
                        </button>
                        <div>
                            <button type="reset" name="btn_batal" class="btn btn-secondary me-2" style="border-radius: 0.5rem;">
                                <i class="bi bi-arrow-counterclockwise me-2"></i>Reset
                            </button>
                            <a href="{{ url('pinjam') }}" class="btn btn-secondary" style="border-radius: 0.5rem;">
                                <i class="bi bi-arrow-left me-2"></i>Kembali
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection

@section('scripts')
<script>
    // Set default tanggal pinjam ke hari ini
    document.addEventListener('DOMContentLoaded', function() {
        const tglPinjam = document.getElementById('tgl_pinjam');
        const tglKembali = document.getElementById('tgl_kembali');
        
        if (!tglPinjam.value) {
            const today = new Date().toISOString().split('T')[0];
            tglPinjam.value = today;
        }
        
        // Set tanggal kembali default 7 hari dari sekarang
        if (!tglKembali.value && tglPinjam.value) {
            const pinjamDate = new Date(tglPinjam.value);
            pinjamDate.setDate(pinjamDate.getDate() + 7);
            tglKembali.value = pinjamDate.toISOString().split('T')[0];
        }
    });
</script>
@endsection
