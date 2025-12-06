<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    
    {{-- PERBAIKAN: Judul halaman diubah --}}
    <title>Tampilan home aplikasi perpus</title>
    
    <style>
        /* CSS Sederhana agar mirip gambar */
        body {
            margin-left: 20px;
        }
        ol li {
            margin-bottom: 5px; /* Memberi sedikit jarak antar link */
        }
        a {
            text-decoration: underline;
            color: blue;
        }
    </style>
</head>
<body>
    {{-- Judul ini sudah benar --}}
    <h1>Aplikasi Perpustakaan FTIK USM</h1>
    
    {{-- PERBAIKAN: Menambahkan "Pilihan menu" --}}
    <p>Pilihan menu :</p>

    {{-- PERBAIKAN: Mengubah link menjadi daftar berurutan --}}
    <ol>
        <li>
            {{-- Teks link diubah --}}
            <a href="{{ url('/buku') }}">Kelola data buku</a>
        </li>
        <li>
            {{-- Teks link diubah --}}
            <a href="{{ url('/anggota') }}">Kelola data anggota</a>
        </li>
        <li>
            {{-- Link baru ditambahkan --}}
            <a href="{{ url('/pinjam') }}">Transaksi Pinjam</a>
        </li>
    </ol>

</body>
</html>