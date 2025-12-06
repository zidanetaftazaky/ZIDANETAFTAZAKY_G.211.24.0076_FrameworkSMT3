@extends('layouts.app')

@section('title', 'Edit Anggota - Aplikasi Perpustakaan')
@section('page-title', 'Edit Anggota')

@section('content')
<div class="page-header">
    <h1><i class="bi bi-pencil me-2"></i>Edit Anggota</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('perpus') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('anggota') }}">Daftar Anggota</a></li>
            <li class="breadcrumb-item active">Edit Anggota</li>
        </ol>
    </nav>
</div>

<div class="card-modern">
    <div class="card-header-modern">
        <i class="bi bi-person-check me-2"></i>Form Edit Anggota
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

        <form action="{{ url('anggota/save') }}" method="POST" accept-charset="utf-8">
            @csrf
            <input type="hidden" name="id" value="{{ $query->ID_Anggota }}">
            <input type="hidden" name="is_update" value="{{ $is_update ?? 1 }}">

            <div class="row g-3">
                <div class="col-md-12">
                    <label for="nim" class="form-label">
                        <i class="bi bi-card-text me-1"></i>NIM <span class="text-danger">*</span>
                    </label>
                    <input type="text"
                           name="nim"
                           id="nim"
                           class="form-control"
                           value="{{ old('nim', $query->nim ?? '') }}"
                           maxlength="20"
                           required>
                </div>

                <div class="col-md-12">
                    <label for="nama" class="form-label">
                        <i class="bi bi-person me-1"></i>Nama Lengkap <span class="text-danger">*</span>
                    </label>
                    <input type="text"
                           name="nama"
                           id="nama"
                           class="form-control"
                           value="{{ old('nama', $query->nama ?? '') }}"
                           maxlength="100"
                           required>
                </div>

                <div class="col-md-12">
                    <label for="progdi" class="form-label">
                        <i class="bi bi-mortarboard me-1"></i>Program Studi <span class="text-danger">*</span>
                    </label>
                    <select name="progdi" id="progdi" class="form-select" required>
                        <option value="">-- Pilih Program Studi --</option>
                        @foreach($optprogdi as $key => $value)
                            <option value="{{ $key }}" {{ old('progdi', $query->progdi ?? '') == $key ? 'selected' : '' }}>
                                {{ $value }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 mt-4">
                    <div class="d-flex justify-content-between">
                        <button type="submit" name="btn_simpan" class="btn btn-primary-modern">
                            <i class="bi bi-check-circle me-2"></i>Simpan Perubahan
                        </button>
                        <a href="{{ url('anggota') }}" class="btn btn-secondary" style="border-radius: 0.5rem;">
                            <i class="bi bi-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
