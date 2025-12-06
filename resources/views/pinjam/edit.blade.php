@extends('layouts.app')

@section('title', 'Edit Peminjaman - Aplikasi Perpustakaan')
@section('page-title', 'Edit Peminjaman')

@section('content')
<div class="page-header">
    <h1><i class="bi bi-pencil-square me-2"></i>Edit Peminjaman Buku</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('perpus') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('pinjam') }}">Daftar Peminjaman</a></li>
            <li class="breadcrumb-item active">Edit Peminjaman</li>
        </ol>
    </nav>
</div>

<div class="card-modern">
    <div class="card-header-modern">
        <i class="bi bi-journal-check me-2"></i>Form Edit Peminjaman Buku
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
            <input type="hidden" name="id" value="{{ $query->ID_Pinjam }}">
            <input type="hidden" name="is_update" value="{{ $is_update ?? 1 }}">

            <div class="row g-3">
                <div class="col-md-12">
                    <label for="ID_Anggota" class="form-label">
                        <i class="bi bi-person me-1"></i>Anggota <span class="text-danger">*</span>
                    </label>
                    <select name="ID_Anggota" id="ID_Anggota" class="form-select" required>
                        <option value="">-- Pilih Anggota --</option>
                        @foreach($optanggota as $key => $value)
                            <option value="{{ $key }}" {{ old('ID_Anggota', $query->ID_Anggota) == $key ? 'selected' : '' }}>
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
                            <option value="{{ $key }}" {{ old('ID_Buku', $query->ID_Buku) == $key ? 'selected' : '' }}>
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
                           value="{{ old('tgl_pinjam', $query->tgl_pinjam) }}" 
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
                           value="{{ old('tgl_kembali', $query->tgl_kembali) }}" 
                           required>
                </div>

                <div class="col-12 mt-4">
                    <div class="d-flex justify-content-between">
                        <button type="submit" name="btn_simpan" class="btn btn-primary-modern">
                            <i class="bi bi-check-circle me-2"></i>Simpan Perubahan
                        </button>
                        <a href="{{ url('pinjam') }}" class="btn btn-secondary" style="border-radius: 0.5rem;">
                            <i class="bi bi-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection


