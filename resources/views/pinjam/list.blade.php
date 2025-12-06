@extends('layouts.app')

@section('title', 'Daftar Peminjaman - Aplikasi Perpustakaan')
@section('page-title', 'Transaksi Peminjaman')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="bi bi-journal-text me-2"></i>Daftar Peminjaman Buku</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('perpus') }}">Home</a></li>
                    <li class="breadcrumb-item active">Daftar Peminjaman</li>
                </ol>
            </nav>
        </div>
        <a href="{{ url('pinjam/add') }}" class="btn btn-success-modern">
            <i class="bi bi-plus-circle me-2"></i>Tambah Peminjaman
        </a>
    </div>
</div>

<div class="card-modern">
    <div class="card-header-modern">
        <i class="bi bi-list-ul me-2"></i>Data Peminjaman
    </div>
    <div class="card-body-modern">
        @if($errors->any())
            <div class="alert alert-danger">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="table-responsive">
            <table class="table table-modern">
                <thead>
                    <tr>
                        <th style="width: 60px;" class="text-center">No</th>
                        <th>Nama Anggota</th>
                        <th>Judul Buku</th>
                        <th>Tanggal Pinjam</th>
                        <th>Tanggal Kembali</th>
                        <th style="width: 120px;" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($query as $row)
                    <tr>
                        <td class="text-center">
                            {{ ($query->currentPage() - 1) * $query->perPage() + $loop->iteration }}
                        </td>
                        <td>
                            <div>
                                <strong>{{ $row->nim }}</strong>
                            </div>
                            <small class="text-muted">{{ $row->nama }}</small>
                        </td>
                        <td>
                            <strong>{{ $row->Judul }}</strong>
                        </td>
                        <td>
                            <span class="badge badge-modern" style="background: #d8f0e4; color: var(--primary-blue);">
                                <i class="bi bi-calendar-event me-1"></i>{{ $row->tgl_pinjam }}
                            </span>
                        </td>
                        <td>
                            <span class="badge badge-modern" style="background: #fef3c7; color: #f59e0b;">
                                <i class="bi bi-calendar-check me-1"></i>{{ $row->tgl_kembali }}
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="{{ url('pinjam/edit/'.$row->ID_Pinjam) }}" 
                               class="btn btn-sm btn-warning me-1" 
                               style="border-radius: 0.5rem;"
                               title="Edit">
                                Edit
                            </a>
                            <a href="{{ url('pinjam/delete/'.$row->ID_Pinjam) }}" 
                               class="btn btn-sm btn-danger" 
                               style="border-radius: 0.5rem;"
                               onclick="return confirm('Yakin ingin menghapus data peminjaman ini?')"
                               title="Hapus">
                                Hapus
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="6" class="text-center text-muted py-4">
                            <i class="bi bi-inbox" style="font-size: 2rem; display: block; margin-bottom: 0.5rem;"></i>
                            Tidak ada data peminjaman.
                        </td>
                    </tr>
                    @endforelse
                </tbody>
            </table>
        </div>

        @if($query->hasPages())
        <div class="d-flex justify-content-center mt-4">
            {{ $query->links('pagination::bootstrap-5') }}
        </div>
        @endif
    </div>
</div>
@endsection
