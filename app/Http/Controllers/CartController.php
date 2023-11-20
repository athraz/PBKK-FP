<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Menu;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CartController extends Controller
{
    public function index()
    {
        $menus = Menu::all();
        $types = Type::all();
        $carts = Cart::all();
        return view('cart.index', compact('menus', 'types', 'carts'));
    }

    public function store(Request $request)
    {
        $request->validate(
            ['quantity' => 'gt:0'],
            ['quantity.gt' => 'Quantity can\'t be 0!']
        );

        $existingCart = Cart::where('user_id', Auth::user()->id)->where('menu_id', $request->menu_id)->first();

        if ($existingCart) {
            $existingCart->update([
                'quantity' => $existingCart->quantity + $request->quantity,
            ]);
        } else {
            Cart::create([
                'user_id' => Auth::user()->id,
                'menu_id' => $request->menu_id,
                'quantity' => $request->quantity
            ]);
        }

        return redirect('/menu');
    }

    public function update(Request $request)
    {
        $userId = Auth::user()->id;
        $carts = DB::table('carts')->where('user_id', $userId)->get();

        foreach ($carts as $cart) {
            $menuId = $cart->menu_id;
            $quantityFieldName = 'quantity-' . $menuId;

            if ($request->has($quantityFieldName)) {
                $newQuantity = $request->input($quantityFieldName);

                DB::table('carts')
                    ->where('user_id', $userId)
                    ->where('menu_id', $menuId)
                    ->update(['quantity' => $newQuantity]);
            }
        }

        return redirect('/order/create');
    }

    public function delete($id)
    {
        $cart = Cart::findOrFail($id);
        return view('cart.delete', compact('cart'));
    }

    public function destroy(Request $request)
    {
        Cart::findOrFail($request->id)->delete();
        return redirect('/cart');
    }
}
