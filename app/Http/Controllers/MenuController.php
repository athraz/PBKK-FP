<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderMenu;
use App\Models\Review;
use App\Models\Type;
use App\Models\Promo;
use App\Models\PromoMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class MenuController extends Controller
{
    public function dashboard(){
        $menus = Menu::all();
        $promos = Promo::all();
        $promomenus = PromoMenu::all();
        $reviews = Review::all();
        return view('dashboard', compact('menus', 'promos', 'promomenus', 'reviews'));
    }

    public function index()
    {
        $menus = Cache::remember('menus', 600, function () {
            return Menu::all();
        });
        $types = Type::all();
        $ordermenus = OrderMenu::all();
        $reviews = Review::all();
        return view('menu.index', compact('menus', 'types', 'ordermenus', 'reviews'));
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
                'original_price' => $request->price,
                'description' => $request->description,
                'photo' => $file_new
            ]);

            Cache::forget('menus');
        }

        return redirect('/menu');
    }

    public function show($id)
    {
        $menu = Menu::findOrFail($id);
        $types = Type::all();
        $reviews = Review::all();
        $orders = Order::all();
        $ordermenus = OrderMenu::all();
        return view('menu.show', compact('menu', 'types', 'reviews', 'orders', 'ordermenus'));
    }

    public function edit($id)
    {
        $menu = Menu::findOrFail($id);
        $types = Type::all();
        return view('menu.edit', compact('menu', 'types'));
    }

    public function update(Request $request, $id)
    {
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
                'original_price' => $request->price,
                'description' => $request->description,
                'photo' => $file_new
            ]);
        }
        else {
            Menu::findOrFail($id)->update([
                'name' => $request->name,
                'type_id' => $request->type,
                'price' => $request->price,
                'original_price' => $request->price,
                'description' => $request->description
            ]);
        }

        Cache::forget('menus');
        $menu = Menu::findOrFail($id);
        $types = Type::all();
        $reviews = Review::all();
        $orders = Order::all();
        $ordermenus = OrderMenu::all();
        return view('menu.show', compact('menu', 'types', 'reviews', 'orders', 'ordermenus'));
    }

    public function destroy($id)
    {
        Menu::findOrFail($id)->delete();
        Cache::forget('menus');
        return redirect('/menu');
    }
}
