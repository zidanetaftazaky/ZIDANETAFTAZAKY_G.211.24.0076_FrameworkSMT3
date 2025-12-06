<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Anggota_m;

class AnggotaController extends Controller
{
    var $data;

    public function __construct()
    {
        // Pilihan program studi
        $this->data['opt_progdi'] = [
            '' => '- Pilih salah satu -',
            'TI' => 'Teknik Informatika',
            'SI' => 'Sistem Informasi',
            'IK' => 'Ilmu Komunikasi'
        ];
    }

    // Menampilkan daftar anggota
  // MENJADI SEPERTI INI:
    public function index() // Hapus parameter (Anggota_m $anggota)
    {
        $data = [
            // Panggil Paginate(5) langsung dari Model Anggota
            'query' => Anggota_m::Paginate(5), // <-- INI PERBAIKANNYA
            'optprogdi' => $this->data['opt_progdi']
        ];
        return view('anggota.list', $data);
    }
    // Menampilkan form tambah anggota
    public function add() // Pastikan nama fungsi ini 'add'
    {
        $data = [
            'is_update' => 0,
            'optprogdi' => $this->data['opt_progdi']
        ];
        return view('anggota.add', $data);
    }

    // Simpan atau update data anggota
    public function save(Anggota_m $anggota, Request $request) // Pastikan Request $request ada
    {
        // ================================================
        // == VALIDASI DITAMBAHKAN DI SINI ==
        // ================================================
        // (Sesuaikan nama 'nim', 'nama', 'progdi' (huruf kecil) 
        // dengan <input name=""> di form Anda)
        $validated = $request->validate([
            'nim' => 'required|max:20',
            'nama' => 'required|max:100',
            'progdi' => 'required',
        ]);
        // ================================================

        // (Pastikan 'name' di sini juga huruf kecil)
        $data['nim']   = $request->input('nim');
        $data['nama']  = $request->input('nama');
        $data['progdi'] = $request->input('progdi');
        $is_update     = $request->input('is_update');

        if ($is_update == 0) {
            // Tambah baru
            if ($anggota->insert_record($data)) {
                return redirect('anggota');
            }
        } else {
            // Update data lama
            $id = $request->input('id');
            if ($anggota->update_by_id($data, $id)) {
                return redirect('anggota');
            }
        }
    }

    // Menampilkan form edit data anggota
    public function edit($id, Anggota_m $anggota)
    {
        $data = [
            'query' => $anggota->get_records($id)->first(),
            'is_update' => 1,
            'optprogdi' => $this->data['opt_progdi']
        ];
        return view('anggota.edit', $data);
    }

    // Hapus data anggota
    public function delete($id, Anggota_m $anggota)
    {
        if ($anggota->delete_by_id($id)) {
            return redirect('anggota');
        }
    }
}