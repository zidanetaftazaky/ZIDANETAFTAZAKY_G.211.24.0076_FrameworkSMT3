# 📚 Dokumentasi Aplikasi Perpustakaan FTIK USM

## Daftar Isi
1. [Struktur Aplikasi](#struktur-aplikasi)
2. [Layout Utama (layouts/app.blade.php)](#layout-utama)
3. [Halaman Login](#halaman-login)
4. [Dashboard](#dashboard)
5. [Halaman CRUD Buku](#halaman-crud-buku)
6. [Halaman CRUD Anggota](#halaman-crud-anggota)
7. [Halaman CRUD Peminjaman](#halaman-crud-peminjaman)
8. [Sistem Warna & Styling](#sistem-warna--styling)
9. [Komponen UI yang Digunakan](#komponen-ui-yang-digunakan)

---

## Struktur Aplikasi

```
resources/views/
├── layouts/
│   └── app.blade.php          # Layout utama dengan sidebar & navbar
├── perpus/
│   ├── login.blade.php        # Halaman login
│   └── main.blade.php         # Dashboard
├── buku/
│   ├── list.blade.php         # Daftar buku
│   ├── add.blade.php          # Form tambah buku
│   └── edit.blade.php         # Form edit buku
├── anggota/
│   ├── list.blade.php         # Daftar anggota
│   ├── add.blade.php          # Form tambah anggota
│   └── edit.blade.php         # Form edit anggota
└── pinjam/
    ├── list.blade.php         # Daftar peminjaman
    └── add.blade.php          # Form tambah peminjaman
```

---

## Layout Utama

### File: `views/layouts/app.blade.php`

**Fungsi:** Template dasar yang digunakan oleh semua halaman (kecuali login).

### Bagian-Bagian Layout:

#### 1. **Head Section** (Baris 1-12)
```php
@yield('title', 'Aplikasi Perpustakaan FTIK USM')
```
- **@yield('title')**: Setiap halaman bisa override title
- **Bootstrap 5 CSS**: Framework CSS modern
- **Bootstrap Icons**: Library icon yang digunakan

#### 2. **CSS Variables** (Baris 14-23)
```css
:root {
    --primary-blue: #1e40af;      /* Biru utama */
    --secondary-blue: #3b82f6;    /* Biru sekunder */
    --light-blue: #dbeafe;        /* Biru terang */
    --accent-blue: #2563eb;       /* Biru aksen */
    --dark-gray: #374151;         /* Abu-abu gelap */
    --light-gray: #f3f4f6;        /* Abu-abu terang */
    --white: #ffffff;             /* Putih */
}
```
**Fungsi:** Warna-warna ini digunakan konsisten di seluruh aplikasi.

#### 3. **Sidebar** (Baris 38-120)
```html
<aside class="sidebar">
    <div class="sidebar-header">...</div>
    <nav class="sidebar-menu">...</nav>
</aside>
```

**Fitur Sidebar:**
- **Fixed Position**: Selalu terlihat di kiri layar
- **Gradient Background**: Biru gelap ke biru terang
- **Menu Items**: 
  - Dashboard (icon: `bi-house-door`)
  - Kelola Buku (icon: `bi-book`)
  - Kelola Anggota (icon: `bi-people`)
  - Transaksi Peminjaman (icon: `bi-journal-text`)
- **Active State**: Menu yang aktif ditandai dengan background lebih terang
- **Hover Effect**: Border kiri putih saat hover

**Kode Active Detection:**
```php
{{ request()->is('buku*') ? 'active' : '' }}
```
Menandai menu aktif berdasarkan URL saat ini.

#### 4. **Top Navbar** (Baris 200-220)
```html
<nav class="top-navbar">
    <div>...</div>
    <div class="user-menu">
        <form action="{{ url('/logout') }}" method="POST">
            <button type="submit" class="btn-logout">Logout</button>
        </form>
    </div>
</nav>
```

**Fitur:**
- **Sticky**: Tetap di atas saat scroll
- **Page Title**: Menampilkan judul halaman
- **Logout Button**: Tombol merah di kanan atas
- **Mobile Toggle**: Tombol hamburger untuk mobile (baris 205)

#### 5. **Content Wrapper** (Baris 222-240)
```php
<div class="content-wrapper">
    @if(session('success'))
        <div class="alert alert-success">...</div>
    @endif
    
    @yield('content')
</div>
```

**Fungsi:**
- **Alert Messages**: Menampilkan pesan sukses/error dari session
- **@yield('content')**: Tempat konten halaman di-inject

#### 6. **JavaScript** (Baris 280-300)
```javascript
// Sidebar toggle untuk mobile
document.getElementById('sidebarToggle')?.addEventListener('click', function() {
    document.querySelector('.sidebar').classList.toggle('show');
});
```

**Fungsi:**
- Toggle sidebar di mobile
- Close sidebar saat klik di luar area sidebar

---

## Halaman Login

### File: `views/perpus/login.blade.php`

**Fungsi:** Halaman autentikasi pengguna.

### Bagian-Bagian:

#### 1. **Background Gradient** (Baris 26)
```css
background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
```
Background ungu gradient untuk efek modern.

#### 2. **Login Card** (Baris 39-44)
```html
<div class="login-card">
    <div class="login-header">...</div>
    <div class="login-body">...</div>
</div>
```

**Fitur:**
- **Card Putih**: Kontras dengan background gradient
- **Rounded Corners**: Border radius 1.5rem
- **Shadow**: Box shadow untuk efek depth
- **Animation**: Slide up saat halaman dimuat

#### 3. **Login Header** (Baris 120-130)
```html
<div class="login-header">
    <i class="bi bi-shield-lock"></i>
    <h2>Selamat Datang</h2>
    <p>Aplikasi Perpustakaan FTIK USM</p>
</div>
```
Header dengan icon, judul, dan subtitle.

#### 4. **Alert Messages** (Baris 135-150)
```php
@if(session('loginError'))
    <div class="alert alert-danger">...</div>
@endif

@if(session('success'))
    <div class="alert alert-success">...</div>
@endif
```
Menampilkan pesan error atau sukses dari controller.

#### 5. **Form Login** (Baris 152-180)
```html
<form action="{{ url('login') }}" method="POST">
    @csrf
    <div class="input-group">
        <span class="input-group-text">
            <i class="bi bi-person-fill"></i>
        </span>
        <input type="text" name="username" ...>
    </div>
    ...
</form>
```

**Fitur:**
- **Input Group**: Icon di dalam input field
- **CSRF Protection**: `@csrf` untuk keamanan
- **Auto Focus**: Field username otomatis fokus
- **Required Fields**: Validasi HTML5

---

## Dashboard

### File: `views/perpus/main.blade.php`

**Fungsi:** Halaman utama setelah login, menampilkan statistik dan quick menu.

### Bagian-Bagian:

#### 1. **Page Header** (Baris 6-16)
```php
<div class="page-header">
    <h1><i class="bi bi-speedometer2 me-2"></i>Dashboard</h1>
    <nav aria-label="breadcrumb">...</nav>
</div>
```
Judul halaman dengan breadcrumb navigation.

#### 2. **Statistics Cards** (Baris 18-80)
```php
<div class="row g-4 mb-4">
    <div class="col-md-4">
        <div class="card-modern">
            <div class="card-body-modern">
                <h6>Total Buku</h6>
                <h2>{{ $total_buku ?? 0 }}</h2>
                <i class="bi bi-book"></i>
            </div>
        </div>
    </div>
    ...
</div>
```

**3 Kartu Statistik:**
1. **Total Buku**: Menampilkan jumlah buku
2. **Total Anggota**: Menampilkan jumlah anggota
3. **Pinjaman Aktif**: Menampilkan jumlah pinjaman aktif

**Fitur:**
- **Icon Besar**: Icon di kanan setiap card
- **Link**: Link "Lihat semua" ke halaman detail
- **Warna Berbeda**: Setiap card punya warna berbeda

#### 3. **Quick Menu** (Baris 82-130)
```php
<div class="card-modern">
    <div class="card-header-modern">Menu Cepat</div>
    <div class="card-body-modern">
        <div class="row g-3">
            <div class="col-md-4">
                <a href="{{ url('buku') }}">
                    <div class="card">...</div>
                </a>
            </div>
        </div>
    </div>
</div>
```

**3 Menu Card:**
1. **Kelola Buku**: Link ke halaman buku
2. **Kelola Anggota**: Link ke halaman anggota
3. **Transaksi Peminjaman**: Link ke halaman pinjam

**Fitur:**
- **Hover Effect**: Card naik saat hover
- **Icon Besar**: Icon di tengah card
- **Deskripsi**: Penjelasan singkat setiap menu

---

## Halaman CRUD Buku

### 1. **List Buku** (`views/buku/list.blade.php`)

#### Struktur:
```php
@extends('layouts.app')
@section('title', 'Daftar Buku')
@section('page-title', 'Kelola Buku')
```

#### Bagian-Bagian:

**a. Page Header dengan Tombol Tambah** (Baris 7-22)
```php
<div class="page-header">
    <div class="d-flex justify-content-between">
        <div>...</div>
        <a href="{{ url('buku/add') }}" class="btn btn-success-modern">
            <i class="bi bi-plus-circle me-2"></i>Tambah Buku
        </a>
    </div>
</div>
```

**b. Table Modern** (Baris 24-70)
```php
<table class="table table-modern">
    <thead>
        <tr>
            <th>No</th>
            <th>Judul</th>
            <th>Pengarang</th>
            <th>Kategori</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
        @forelse($query as $row)
            <tr>...</tr>
        @empty
            <tr>Tidak ada data</tr>
        @endforelse
    </tbody>
</table>
```

**Fitur:**
- **Pagination**: `{{ $query->links() }}`
- **Empty State**: Pesan jika tidak ada data
- **Action Buttons**: Edit dan Hapus dalam satu group

**c. Action Buttons** (Baris 58-65)
```php
<div class="btn-group">
    <a href="{{ url('buku/edit/'.$row['ID_Buku']) }}" 
       class="btn btn-sm btn-warning">
        <i class="bi bi-pencil"></i>
    </a>
    <a href="{{ url('buku/delete/'.$row['ID_Buku']) }}" 
       class="btn btn-sm btn-danger"
       onclick="return confirm('Yakin?')">
        <i class="bi bi-trash"></i>
    </a>
</div>
```

### 2. **Add Buku** (`views/buku/add.blade.php`)

#### Struktur Form:
```php
<form action="{{ url('buku/save') }}" method="POST">
    @csrf
    <input type="hidden" name="id" value="">
    <input type="hidden" name="is_update" value="{{ $is_update }}">
    
    <!-- Field Judul -->
    <input type="text" name="Judul" ...>
    
    <!-- Field Pengarang -->
    <input type="text" name="Pengarang" ...>
    
    <!-- Field Kategori -->
    <select name="Kategori" ...>
        @foreach($optkategori as $key => $value)
            <option value="{{ $key }}">{{ $value }}</option>
        @endforeach
    </select>
    
    <!-- Buttons -->
    <button type="submit">Simpan</button>
    <a href="{{ url('buku') }}">Kembali</a>
</form>
```

**Fitur:**
- **Validation Errors**: Menampilkan error dari `$errors`
- **Old Values**: `old('Judul')` untuk mempertahankan input saat error
- **Required Fields**: Validasi HTML5
- **Max Length**: Batas karakter input

### 3. **Edit Buku** (`views/buku/edit.blade.php`)

**Perbedaan dengan Add:**
- `value="{{ $query->Judul }}"` - Mengisi dengan data existing
- `name="id" value="{{ $query->ID_Buku }}"` - ID untuk update
- `name="is_update" value="1"` - Flag untuk update

---

## Halaman CRUD Anggota

### Struktur Mirip dengan Buku

### **Perbedaan Penting:**

#### 1. **Field Names** (Huruf Kecil)
```php
<!-- BENAR -->
<input name="nim" value="{{ $query->nim }}">
<input name="nama" value="{{ $query->nama }}">
<select name="progdi">...</select>

<!-- SALAH (akan error) -->
<input name="NIM" value="{{ $query->NIM }}">
<input name="Nama" value="{{ $query->Nama }}">
```

**Alasan:** Controller mengharapkan field name lowercase.

#### 2. **Old Values dengan Fallback**
```php
value="{{ old('nim', $query->nim ?? '') }}"
```

**Fungsi:**
- Jika ada error validasi: gunakan `old('nim')`
- Jika tidak ada error: gunakan `$query->nim`
- Jika data tidak ada: gunakan string kosong

---

## Halaman CRUD Peminjaman

### 1. **List Peminjaman** (`views/pinjam/list.blade.php`)

**Fitur Khusus:**
- **Badge untuk Tanggal**: Tanggal pinjam dan kembali ditampilkan dalam badge
- **Info Anggota**: NIM dan Nama ditampilkan bersamaan

```php
<td>
    <div><strong>{{ $row->nim }}</strong></div>
    <small class="text-muted">{{ $row->nama }}</small>
</td>
```

### 2. **Add Peminjaman** (`views/pinjam/add.blade.php`)

**Fitur Khusus:**

#### a. **Auto-fill Tanggal** (JavaScript)
```javascript
document.addEventListener('DOMContentLoaded', function() {
    const tglPinjam = document.getElementById('tgl_pinjam');
    const tglKembali = document.getElementById('tgl_kembali');
    
    // Set tanggal pinjam = hari ini
    if (!tglPinjam.value) {
        const today = new Date().toISOString().split('T')[0];
        tglPinjam.value = today;
    }
    
    // Set tanggal kembali = 7 hari dari sekarang
    if (!tglKembali.value && tglPinjam.value) {
        const pinjamDate = new Date(tglPinjam.value);
        pinjamDate.setDate(pinjamDate.getDate() + 7);
        tglKembali.value = pinjamDate.toISOString().split('T')[0];
    }
});
```

**Fungsi:** Otomatis mengisi tanggal pinjam (hari ini) dan tanggal kembali (7 hari kemudian).

#### b. **Select Dropdown**
```php
<select name="ID_Anggota">
    <option value="">-- Pilih Anggota --</option>
    @foreach($optanggota as $key => $value)
        <option value="{{ $key }}">{{ $value }}</option>
    @endforeach
</select>
```

**Fungsi:** Dropdown untuk memilih anggota dan buku dari data yang ada.

---

## Sistem Warna & Styling

### 1. **Color Palette**

| Variabel | Kode Warna | Penggunaan |
|----------|------------|------------|
| `--primary-blue` | `#1e40af` | Sidebar, header, tombol utama |
| `--secondary-blue` | `#3b82f6` | Hover states, link |
| `--light-blue` | `#dbeafe` | Background badge, highlight |
| `--accent-blue` | `#2563eb` | Gradient, emphasis |
| `--dark-gray` | `#374151` | Text utama |
| `--light-gray` | `#f3f4f6` | Background body |

### 2. **Component Classes**

#### a. **Card Modern**
```css
.card-modern {
    background: white;
    border-radius: 1rem;
    box-shadow: 0 1px 3px rgba(0, 0, 0, 0.1);
    transition: all 0.3s ease;
}

.card-modern:hover {
    box-shadow: 0 4px 12px rgba(0, 0, 0, 0.15);
}
```

#### b. **Button Modern**
```css
.btn-primary-modern {
    background: var(--primary-blue);
    border: none;
    color: white;
    padding: 0.625rem 1.25rem;
    border-radius: 0.5rem;
    transition: all 0.3s ease;
}

.btn-primary-modern:hover {
    background: var(--accent-blue);
    transform: translateY(-2px);
    box-shadow: 0 4px 8px rgba(30, 64, 175, 0.3);
}
```

#### c. **Table Modern**
```css
.table-modern thead {
    background: var(--light-blue);
}

.table-modern thead th {
    color: var(--primary-blue);
    font-weight: 600;
    text-transform: uppercase;
}
```

---

## Komponen UI yang Digunakan

### 1. **Bootstrap 5**
- Grid System: `row`, `col-md-*`
- Components: `card`, `table`, `form`, `button`, `alert`
- Utilities: `d-flex`, `justify-content-between`, `mb-4`

### 2. **Bootstrap Icons**
- Navigation: `bi-house-door`, `bi-book`, `bi-people`
- Actions: `bi-pencil`, `bi-trash`, `bi-plus-circle`
- Status: `bi-check-circle`, `bi-exclamation-triangle`

### 3. **Custom CSS**
- CSS Variables untuk konsistensi warna
- Transitions untuk smooth animations
- Responsive design dengan media queries

### 4. **Blade Directives**
- `@extends('layouts.app')` - Extend layout
- `@section('content')` - Define content section
- `@yield('title')` - Output title
- `@csrf` - CSRF token
- `@if`, `@foreach`, `@forelse` - Control structures

---

## Best Practices yang Diterapkan

### 1. **Konsistensi Naming**
- Field names: lowercase (`nim`, `nama`, `progdi`)
- Class names: kebab-case (`card-modern`, `btn-primary-modern`)
- Variables: camelCase di JavaScript

### 2. **Error Handling**
- Validasi di form dengan `required`
- Menampilkan error dari `$errors`
- Old values untuk mempertahankan input

### 3. **User Experience**
- Loading states (animations)
- Hover effects
- Confirmation dialogs untuk delete
- Breadcrumb navigation
- Alert messages

### 4. **Responsive Design**
- Mobile-first approach
- Sidebar collapse di mobile
- Table responsive dengan scroll

### 5. **Security**
- CSRF protection dengan `@csrf`
- Form validation
- SQL injection prevention (Laravel ORM)

---

## Cara Menggunakan

### 1. **Menambahkan Halaman Baru**
```php
@extends('layouts.app')

@section('title', 'Judul Halaman')
@section('page-title', 'Judul di Navbar')

@section('content')
    <!-- Konten halaman -->
@endsection
```

### 2. **Menambahkan Menu di Sidebar**
Edit `views/layouts/app.blade.php`, tambahkan:
```php
<li class="nav-item">
    <a class="nav-link {{ request()->is('menu-baru*') ? 'active' : '' }}" 
       href="{{ url('menu-baru') }}">
        <i class="bi bi-icon-name"></i>
        <span>Nama Menu</span>
    </a>
</li>
```

### 3. **Menggunakan Alert Messages**
Di Controller:
```php
return redirect()->back()->with('success', 'Data berhasil disimpan!');
return redirect()->back()->with('loginError', 'Username atau password salah!');
```

---

## Troubleshooting

### 1. **Form tidak terisi saat edit**
- Pastikan field name lowercase: `nim` bukan `NIM`
- Pastikan `$query->nim` bukan `$query->NIM`
- Gunakan `old('nim', $query->nim ?? '')`

### 2. **Menu tidak aktif**
- Pastikan URL pattern di `request()->is()` sesuai
- Contoh: `request()->is('buku*')` untuk semua URL yang dimulai dengan `buku`

### 3. **Sidebar tidak muncul di mobile**
- Pastikan JavaScript sudah dimuat
- Cek console browser untuk error
- Pastikan class `show` ditambahkan saat toggle

---

## Kesimpulan

Aplikasi ini menggunakan:
- ✅ **Bootstrap 5** untuk framework CSS
- ✅ **Bootstrap Icons** untuk icon
- ✅ **Blade Template** untuk struktur
- ✅ **CSS Variables** untuk konsistensi warna
- ✅ **Responsive Design** untuk mobile
- ✅ **Modern UI/UX** dengan animations dan transitions

Semua halaman mengikuti pola yang sama untuk konsistensi dan kemudahan maintenance.




