<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Anggota_m extends Model
{
    use HasFactory;

    // Nama tabel di database
    protected $table = 'mst_anggota';

    // Primary key tabel
    protected $primaryKey = 'ID_Anggota';

    // Tidak memakai created_at dan updated_at
    public $timestamps = false;

    // Mengambil semua data atau berdasarkan ID
    public function get_records($criteria = '')
    {
        $result = self::select('*')
            ->when($criteria, function ($query, $criteria) {
                return $query->where('ID_Anggota', $criteria);
            })
            ->get();
        return $result;
    }

    // Insert data baru
    public function insert_record($data)
    {
        $result = self::insert($data);
        return $result;
    }

    // Update data berdasarkan ID
    public function update_by_id($data, $id)
    {
        $result = self::where('ID_Anggota', $id)
            ->update($data);
        return $result;
    }

    // Hapus data berdasarkan ID
    public function delete_by_id($id)
    {
        $result = self::where('ID_Anggota', $id)
            ->delete();
        return $result;
    }
    
    // tambahan fungsi untuk transaksi pinjam (dropdown)
    function opt_Anggota()
    {
    $result = self::select('ID_Anggota', 'Nim', 'Nama')
    ->get();
    foreach ($result as $row)
    {
    $rowAnggota[$row->ID_Anggota]=$row->Nim." - ".$row->Nama;
    }
    return $rowAnggota;
    }
}