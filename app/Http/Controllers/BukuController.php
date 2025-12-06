<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Buku_m;

class BukuController extends Controller
{
    var $data;

    public function __construct()
    {
        $this->data['opt_kategori'] = [
            '' => '- Pilih salah satu -',
            'novel' => 'Novel',
            'komik' => 'Komik',
            'kamus' => 'Kamus',
            'program' => 'Pemrograman'
        ];
    }

    // Menampilkan daftar buku
    public function index(Buku_m $buku)
    {
        $data = [
            //'query'=>$buku->get_records(),
            'query' => $buku->paginate(5),
            'optkategori' => $this->data['opt_kategori']
        ];
        return view('buku.list', $data);
    }

    // Menampilkan form tambah buku
    public function add()
    {
        $data = [
            'is_update' => 0,
            'optkategori' => $this->data['opt_kategori']
        ];
        return view('buku.add', $data);
    }

    // Simpan atau update data buku
    public function save(Buku_m $buku, Request $request)
    {
       $validated = $request->validate([
'Judul' => 'required',
'Pengarang' => 'required',
'Kategori' => 'required',
]);

        $data['Judul']     = $request->input('Judul');
        $data['Pengarang'] = $request->input('Pengarang');
        $data['Kategori']  = $request->input('Kategori');
        $is_update         = $request->input('is_update');

        if ($is_update == 0) {
            if ($buku->insert_record($data)) {
                return redirect('buku');
            }
        } else {
            $id = $request->input('id');
            if ($buku->update_by_id($data, $id)) {
                return redirect('buku');
            }
        }
    }

    // Menampilkan form edit data buku
    public function edit($id, Buku_m $buku)
    {
        $data = [
            'query' => $buku->get_records($id)->first(),
            'is_update' => 1,
            'optkategori' => $this->data['opt_kategori']
        ];
        return view('buku.edit', $data);
    }

    // Hapus data buku
    public function delete($id, Buku_m $buku)
    {
        if ($buku->delete_by_id($id)) {
            return redirect('buku');
        }
    }
}
