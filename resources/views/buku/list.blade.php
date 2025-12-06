@extends('layouts.app')

@section('title', 'Daftar Buku - Aplikasi Perpustakaan')
@section('page-title', 'Kelola Buku')

@section('content')
<div class="page-header">
    <div class="d-flex justify-content-between align-items-center">
        <div>
            <h1><i class="bi bi-book me-2"></i>Daftar Buku</h1>
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="{{ url('perpus') }}">Home</a></li>
                    <li class="breadcrumb-item active">Daftar Buku</li>
                </ol>
            </nav>
        </div>
        <a href="{{ url('buku/add') }}" class="btn btn-success-modern">
            <i class="bi bi-plus-circle me-2"></i>Tambah Buku
        </a>
    </div>
</div>

<div class="card-modern">
    <div class="card-header-modern">
        <i class="bi bi-list-ul me-2"></i>Data Buku
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
                        <th>Judul</th>
                        <th>Pengarang</th>
                        <th>Kategori</th>
                        <th style="width: 180px;" class="text-center">Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    @php $no = 1; @endphp
                    @forelse($query as $row)
                    <tr>
                        <td class="text-center">
                            {{ ($query->currentPage() - 1) * $query->perPage() + $loop->iteration }}
                        </td>
                        <td>
                            <strong>{{ $row['Judul'] }}</strong>
                        </td>
                        <td>{{ $row['Pengarang'] }}</td>
                        <td>
                            <span class="badge badge-modern" style="background: var(--light-blue); color: var(--primary-blue);">
                                {{ $optkategori[$row['Kategori']] ?? '-' }}
                            </span>
                        </td>
                        <td class="text-center">
                            <a href="{{ url('buku/edit/'.$row['ID_Buku']) }}" 
                               class="btn btn-sm btn-warning me-1" 
                               style="border-radius: 0.5rem;"
                               title="Edit">
                                Edit
                            </a>
                            <a href="{{ url('buku/delete/'.$row['ID_Buku']) }}" 
                               class="btn btn-sm btn-danger" 
                               style="border-radius: 0.5rem;"
                               onclick="return confirm('Yakin ingin menghapus buku ini?')"
                               title="Hapus">
                                Hapus
                            </a>
                        </td>
                    </tr>
                    @empty
                    <tr>
                        <td colspan="5" class="text-center text-muted py-4">
                            <i class="bi bi-inbox" style="font-size: 2rem; display: block; margin-bottom: 0.5rem;"></i>
                            Tidak ada data buku.
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
