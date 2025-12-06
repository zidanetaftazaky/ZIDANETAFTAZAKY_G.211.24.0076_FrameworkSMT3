<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pinjam_m extends Model
{
    use HasFactory;

    // ==========================================================
    // PERBAIKAN: Nama tabel disesuaikan menjadi 'pinjam'
    // (Asumsi ini adalah nama tabel Anda di phpMyAdmin)
    protected $table = 'pinjam';
    // ==========================================================

    protected $primaryKey = 'ID_Pinjam';
    public $timestamps = false;

    /**
     * Mengambil data peminjaman, langsung JOIN ke anggota dan buku.
     */
    public function get_records($criteria = '')
    {
        // Query ini sekarang akan mencari tabel 'pinjam'
        $result = self::select(
                'pinjam.*', // Mengambil semua kolom dari tabel 'pinjam'
                'mst_anggota.nim', 'mst_anggota.nama',
                'mst_buku.Judul' // Asumsi kolom di mst_buku adalah 'Judul'
            )
            // JOIN ke tabel 'mst_anggota'
            ->join('mst_anggota', 'pinjam.ID_Anggota', '=', 'mst_anggota.ID_Anggota')
            // JOIN ke tabel 'mst_buku'
            ->join('mst_buku', 'pinjam.ID_Buku', '=', 'mst_buku.ID_Buku')
            ->when($criteria, function ($query, $criteria) {
                return $query->where('pinjam.ID_Pinjam', $criteria);
            })
            ->get();
        return $result;
    }

    /**
     * Menyimpan data peminjaman baru.
     */
    public function insert_record($data)
    {
        $result = self::insert($data);
        return $result;
    }

    /**
     * Update data peminjaman berdasarkan ID.
     */
    public function update_by_id($data, $id)
    {
        $result = self::where('ID_Pinjam', $id)
            ->update($data);
        return $result;
    }

    /**
     * Hapus data peminjaman berdasarkan ID.
     */
    public function delete_by_id($id)
    {
        $result = self::where('ID_Pinjam', $id)
            ->delete();
        return $result;
    }
}