@extends('layouts.app')

@section('title', 'Dashboard - Aplikasi Perpustakaan FTIK USM')
@section('page-title', 'Dashboard')

@section('content')
<div class="page-header">
    <h1><i class="bi bi-speedometer2 me-2"></i>Dashboard</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ url('perpus') }}">Home</a></li>
            <li class="breadcrumb-item active">Dashboard</li>
        </ol>
    </nav>
</div>

<!-- Statistics Cards -->
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card-modern">
            <div class="card-body-modern">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted text-uppercase mb-2" style="font-size: 0.85rem;">Total Buku</h6>
                        <h2 class="mb-0" style="color: var(--primary-blue); font-weight: 700;">
                            {{ $total_buku ?? 0 }}
                        </h2>
                    </div>
                    <div style="width: 60px; height: 60px; background: var(--light-blue); border-radius: 1rem; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-book" style="font-size: 2rem; color: var(--primary-blue);"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ url('buku') }}" class="text-decoration-none" style="color: var(--secondary-blue); font-size: 0.9rem;">
                        Lihat semua <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-modern">
            <div class="card-body-modern">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted text-uppercase mb-2" style="font-size: 0.85rem;">Total Anggota</h6>
                        <h2 class="mb-0" style="color: #10b981; font-weight: 700;">
                            {{ $total_anggota ?? 0 }}
                        </h2>
                    </div>
                    <div style="width: 60px; height: 60px; background: #d1fae5; border-radius: 1rem; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-people" style="font-size: 2rem; color: #10b981;"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ url('anggota') }}" class="text-decoration-none" style="color: #10b981; font-size: 0.9rem;">
                        Lihat semua <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card-modern">
            <div class="card-body-modern">
                <div class="d-flex justify-content-between align-items-center">
                    <div>
                        <h6 class="text-muted text-uppercase mb-2" style="font-size: 0.85rem;">Pinjaman Aktif</h6>
                        <h2 class="mb-0" style="color: #f59e0b; font-weight: 700;">
                            {{ $total_pinjaman ?? 0 }}
                        </h2>
                    </div>
                    <div style="width: 60px; height: 60px; background: #fef3c7; border-radius: 1rem; display: flex; align-items: center; justify-content: center;">
                        <i class="bi bi-journal-text" style="font-size: 2rem; color: #f59e0b;"></i>
                    </div>
                </div>
                <div class="mt-3">
                    <a href="{{ url('pinjam') }}" class="text-decoration-none" style="color: #f59e0b; font-size: 0.9rem;">
                        Lihat semua <i class="bi bi-arrow-right"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quick Menu -->
<div class="row g-4">
    <div class="col-12">
        <div class="card-modern">
            <div class="card-header-modern">
                <i class="bi bi-grid me-2"></i>Menu Cepat
            </div>
            <div class="card-body-modern">
                <div class="row g-3">
                    <div class="col-md-4">
                        <a href="{{ url('buku') }}" class="text-decoration-none">
                            <div class="card border-0 shadow-sm h-100" style="transition: all 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 8px 16px rgba(0,0,0,0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 3px rgba(0,0,0,0.1)'">
                                <div class="card-body text-center p-4">
                                    <div style="width: 70px; height: 70px; background: var(--light-blue); border-radius: 1rem; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                                        <i class="bi bi-book" style="font-size: 2.5rem; color: var(--primary-blue);"></i>
                                    </div>
                                    <h5 class="card-title mb-2" style="color: var(--primary-blue);">Kelola Buku</h5>
                                    <p class="card-text text-muted small">Tambah, edit, dan kelola data buku</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4">
                        <a href="{{ url('anggota') }}" class="text-decoration-none">
                            <div class="card border-0 shadow-sm h-100" style="transition: all 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 8px 16px rgba(0,0,0,0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 3px rgba(0,0,0,0.1)'">
                                <div class="card-body text-center p-4">
                                    <div style="width: 70px; height: 70px; background: #d1fae5; border-radius: 1rem; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                                        <i class="bi bi-people" style="font-size: 2.5rem; color: #10b981;"></i>
                                    </div>
                                    <h5 class="card-title mb-2" style="color: #10b981;">Kelola Anggota</h5>
                                    <p class="card-text text-muted small">Tambah, edit, dan kelola data anggota</p>
                                </div>
                            </div>
                        </a>
                    </div>

                    <div class="col-md-4">
                        <a href="{{ url('pinjam') }}" class="text-decoration-none">
                            <div class="card border-0 shadow-sm h-100" style="transition: all 0.3s ease; cursor: pointer;" onmouseover="this.style.transform='translateY(-5px)'; this.style.boxShadow='0 8px 16px rgba(0,0,0,0.15)'" onmouseout="this.style.transform='translateY(0)'; this.style.boxShadow='0 1px 3px rgba(0,0,0,0.1)'">
                                <div class="card-body text-center p-4">
                                    <div style="width: 70px; height: 70px; background: #fef3c7; border-radius: 1rem; display: flex; align-items: center; justify-content: center; margin: 0 auto 1rem;">
                                        <i class="bi bi-journal-text" style="font-size: 2.5rem; color: #f59e0b;"></i>
                                    </div>
                                    <h5 class="card-title mb-2" style="color: #f59e0b;">Transaksi Peminjaman</h5>
                                    <p class="card-text text-muted small">Kelola transaksi peminjaman buku</p>
                                </div>
                            </div>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Recent Activity (Optional) -->
<div class="row g-4 mt-2">
    <div class="col-12">
        <div class="card-modern">
            <div class="card-header-modern">
                <i class="bi bi-clock-history me-2"></i>Aktivitas Terkini
            </div>
            <div class="card-body-modern">
                <p class="text-muted mb-0">
                    <i class="bi bi-info-circle me-2"></i>
                    Sistem perpustakaan siap digunakan. Pilih menu di atas untuk mulai mengelola data.
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
