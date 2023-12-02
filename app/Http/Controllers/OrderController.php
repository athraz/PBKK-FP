<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Order;
use App\Models\OrderMenu;
use App\Models\Type;
use App\Models\Cart;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class OrderController extends Controller
{
    public function index()
    {
        $orders = Order::all();
        $ordermenus = OrderMenu::all();
        $menus = Menu::all();
        return view('order.index', compact('orders', 'ordermenus', 'menus'));
    }

    public function create()
    {
        $menus = Menu::all();
        $types = Type::all();
        $carts = Cart::all();
        return view('order.create', compact('menus', 'types', 'carts'));
    }

    public function store(Request $request)
    {
        // dd($request->address);
        $request->validate(
            [
                'payment_method' => 'required|not_in:null',
                'address' => 'required'
            ],
            [
                'payment_method.gt' => 'Please select a payment method!',
                'address.required' => 'Address can\'t be empty!'
            ]
        );
        
        $order = Order::create([
            'user_id' => Auth::user()->id,
            'total_price' => $request->total_price,
            'payment_method' => $request->payment_method,
            'address' => $request->address,
            'status' => 'Waiting',
            'employee_id' => Auth::user()->id
        ]);

        $carts = Cart::where('user_id', Auth::user()->id)->get();

        foreach ($carts as $cart) {
            OrderMenu::create([
                'order_id' => $order->id,
                'menu_id' => $cart->menu_id,
                'quantity' => $cart->quantity,
                'order_price' => Menu::findOrFail($cart->menu_id)->price
            ]);
        }

        Cart::where('user_id', Auth::user()->id)->delete();

        return redirect('/order');
    }

    public function take($id)
    {
        Order::findOrFail($id)->update([
            'status' => 'On Delivery',
            'employee_id' => Auth::user()->id,
        ]);

        return redirect('/order');
    }

    public function done($id)
    {
        Order::findOrFail($id)->update([
            'status' => 'Delivered',
        ]);

        return redirect('/order');
    }
}
