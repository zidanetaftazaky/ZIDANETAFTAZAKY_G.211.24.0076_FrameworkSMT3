<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Buku_m extends Model
{
    use HasFactory;
    protected $table = 'mst_buku';
    protected $primaryKey = 'ID_Buku';
    public $timestamps = false;


    function get_records($criteria='')
{
    $result = self::select('*')
      ->when($criteria, function($query,$criteria){
        return $query->where('ID_Buku',$criteria);
      })
      ->get();
      return $result;
  }
  function insert_record($data)
{
$result = self:: insert($data);
return $result;
}
function update_by_id($data, $id)
{
$result = self:: where ('ID_Buku', $id)
->update($data);
return $result;
}
function delete_by_id($id)
{
$result = self::where('ID_Buku', $id)
->delete();
return $result;
 
}

// tambahan fungsi untuk transaksi pinjam (dropdown)
function opt_Buku()
{
$result = self:: select('ID_Buku', 'Judul', 'Pengarang')
->get();
foreach ($result as $row)
{
$rowBuku [$row->ID_Buku]=$row->Judul." ".$row->Pengarang;
}
return $rowBuku;
}

}