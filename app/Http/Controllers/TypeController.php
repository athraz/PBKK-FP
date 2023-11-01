<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Type;
use Illuminate\Http\Request;

class TypeController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        $types = Type::all();
        return view('type.index', compact('menus', 'types'));
    }

    public function create()
    {
        return view('type.create');
    }

    public function store(Request $request)
    {
        $request->validate(
            ['name' => 'required',],
            ['name.required' => 'Name can\'t be empty!',]
        );
        Type::create(['name' => $request->name,]);
        return redirect('/type');
    }

    public function edit($id)
    {
        $type = Type::findOrFail($id);
        return view('type.edit', compact('type'));
    }

    public function update(Request $request, $id)
    {
        $request->validate(
            ['name' => 'required',],
            ['name.required' => 'Name can\'t be empty!',]
        );
        Type::findOrFail($id)->update(['name' => $request->name,]);

        return redirect('/type');
    }

    public function destroy($id)
    {
        Type::findOrFail($id)->delete();
        return redirect('/type');
    }
}
