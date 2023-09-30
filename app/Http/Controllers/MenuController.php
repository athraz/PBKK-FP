<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        return view('menu.index', compact('menus'));
    }

    public function create()
    {
        return view('menu.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'nama' => 'required',
                'jenis' => 'gt:0',
                'harga' => 'required|numeric',
                'deskripsi' => 'required',
                'foto' => 'required|mimes:jpeg,jpg,png'
            ],
            [
                'nama.required' => 'Masukkan nama menu!',
                'jenis.gt' => 'Pilih jenis menu!',
                'harga.required' => 'Masukkan harga menu!',
                'harga.numeric' => 'Harga harus berupa bilangan',
                'deskripsi.required' => 'Masukkan deskripsi menu!',
                'foto.required' => 'Masukkan foto menu!',
                'foto.mimes' => 'Format foto harus jpg, jpeg, atau png!'
            ]
        );

        $file_foto = $request->file('foto');
        if ($file_foto != NULL) {
            $file_ext = $file_foto->extension();
            $file_baru = date('ymdhis') . "." . $file_ext;
            $file_foto->storeAs('public/foto-menu', $file_baru);

            Menu::create([
                'nama' => $request->nama,
                'jenis' => $request->jenis,
                'harga' => $request->harga,
                'deskripsi' => $request->deskripsi,
                'foto' => $file_baru
            ]);
        }

        return redirect('/menu');
    }
}
