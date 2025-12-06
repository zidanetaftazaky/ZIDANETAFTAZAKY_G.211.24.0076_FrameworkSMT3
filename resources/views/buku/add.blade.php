@extends('layouts.app')

@section('title', 'Tambah Buku - Aplikasi Perpustakaan')
@section('page-title', 'Tambah Buku')

@section('content')
<div class="page-header">
    <h1><i class="bi bi-plus-circle me-2"></i>Tambah Buku</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('perpus') }}">Home</a></li>
            <li class="breadcrumb-item"><a href="{{ url('buku') }}">Daftar Buku</a></li>
            <li class="breadcrumb-item active">Tambah Buku</li>
        </ol>
    </nav>
</div>

<div class="card-modern">
    <div class="card-header-modern">
        <i class="bi bi-book me-2"></i>Form Tambah Buku
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

        <form action="{{ url('buku/save') }}" method="POST" accept-charset="utf-8">
            @csrf
            <input type="hidden" name="id" value="">
            <input type="hidden" name="is_update" value="{{ $is_update }}">

            <div class="row g-3">
                <div class="col-md-12">
                    <label for="Judul" class="form-label">
                        <i class="bi bi-bookmark me-1"></i>Judul Buku <span class="text-danger">*</span>
                    </label>
                    <input type="text"
                           name="Judul"
                           id="Judul"
                           class="form-control"
                           placeholder="Masukkan judul buku"
                           value="{{ old('Judul') }}"
                           maxlength="100"
                           required>
                </div>

                <div class="col-md-12">
                    <label for="Pengarang" class="form-label">
                        <i class="bi bi-person me-1"></i>Pengarang <span class="text-danger">*</span>
                    </label>
                    <input type="text"
                           name="Pengarang"
                           id="Pengarang"
                           class="form-control"
                           placeholder="Masukkan nama pengarang"
                           value="{{ old('Pengarang') }}"
                           maxlength="150"
                           required>
                </div>

                <div class="col-md-12">
                    <label for="Kategori" class="form-label">
                        <i class="bi bi-tags me-1"></i>Kategori <span class="text-danger">*</span>
                    </label>
                    <select name="Kategori" id="Kategori" class="form-select" required>
                        <option value="">-- Pilih Kategori --</option>
                        @foreach($optkategori as $key => $value)
                            <option value="{{ $key }}" {{ old('Kategori') == $key ? 'selected' : '' }}>
                                {{ $value }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <div class="col-12 mt-4">
                    <div class="d-flex justify-content-between">
                        <button type="submit" name="btn_simpan" class="btn btn-success-modern">
                            <i class="bi bi-check-circle me-2"></i>Simpan
                        </button>
                        <a href="{{ url('buku') }}" class="btn btn-secondary" style="border-radius: 0.5rem;">
                            <i class="bi bi-arrow-left me-2"></i>Kembali
                        </a>
                    </div>
                </div>
            </div>
        </form>
    </div>
</div>
@endsection
