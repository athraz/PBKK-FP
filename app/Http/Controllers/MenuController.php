<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Type;
use Illuminate\Http\Request;

class MenuController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        $types = Type::all();
        return view('menu.index', compact('menus', 'types'));
    }

    public function create()
    {
        $types = Type::all();
        return view('menu.create', compact('types'));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate(
            [
                'name' => 'required',
                'type' => 'gt:0',
                'price' => 'required|numeric',
                'description' => 'required',
                'photo' => 'required|mimes:jpg,jpeg,png'
            ],
            [
                'name.required' => 'Name can\'t be empty!',
                'type.gt' => 'Please select menu\'s type!',
                'price.required' => 'Price can\'t be empty!',
                'price.numeric' => 'Price must be numeric!',
                'description.required' => 'Description can\'t be empty!',
                'photo.required' => 'Photo can\'t be empty!',
                'photo.mimes' => 'Allowed extensions are .jpg, .jpeg, and .png!'
            ]
        );

        $file_photo = $request->file('photo');
        if ($file_photo != NULL) {
            $file_ext = $file_photo->extension();
            $file_new = date('ymdhis') . "." . $file_ext;
            $file_photo->storeAs('public/photo-menu', $file_new);

            Menu::create([
                'name' => $request->name,
                'type_id' => $request->type,
                'price' => $request->price,
                'description' => $request->description,
                'photo' => $file_new
            ]);
        }

        return redirect('/menu');
    }

    public function show($id)
    {
        $menus = Menu::findOrFail($id);
        $types = Type::all();
        return view('menu.show', compact('menus', 'types'));
    }

    public function edit($id)
    {
        $menus = Menu::findOrFail($id);
        $types = Type::all();
        return view('menu.edit', compact('menus', 'types'));
    }

    public function update(Request $request, $id)
    {
        // dd($request->all());
        $request->validate(
            [
                'name' => 'required',
                'type' => 'gt:0',
                'price' => 'required|numeric',
                'description' => 'required',
                'photo' => 'mimes:jpg,jpeg,png'
            ],
            [
                'name.required' => 'Name can\'t be empty!',
                'type.gt' => 'Please select menu\'s type!',
                'price.required' => 'Price can\'t be empty!',
                'price.numeric' => 'Price must be numeric!',
                'description.required' => 'Description can\'t be empty!',
                'photo.mimes' => 'Allowed extensions are .jpg, .jpeg, and .png!'
            ]
        );

        $file_photo = $request->file('photo');
        if ($file_photo != NULL) {
            $file_ext = $file_photo->extension();
            $file_new = date('ymdhis') . "." . $file_ext;
            $file_photo->storeAs('public/photo-menu', $file_new);

            Menu::findOrFail($id)->update([
                'name' => $request->name,
                'type_id' => $request->type,
                'price' => $request->price,
                'description' => $request->description,
                'photo' => $file_new
            ]);
        }
        else {
            Menu::findOrFail($id)->update([
                'name' => $request->name,
                'type_id' => $request->type,
                'price' => $request->price,
                'description' => $request->description
            ]);
        }

        $menus = Menu::findOrFail($id);
        return view('menu.show', compact('menus'));
    }

    public function destroy($id)
    {
        Menu::findOrFail($id)->delete();
        return redirect('/menu');
    }
}
