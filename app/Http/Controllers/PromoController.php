<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Promo;
use App\Models\PromoMenu;
use App\Models\Menu;

class PromoController extends Controller
{
    public function index()
    {
        $promos = Promo::all();
        $promomenus = PromoMenu::all();
        $menus = Menu::all();
        return view('promo.index', compact('promos', 'promomenus', 'menus'));
    }

    public function create()
    {
        $menus = Menu::all();
        return view('promo.create', compact('menus'));
    }

    public function store(Request $request)
    {
        $request->validate(
            [
                'name' => 'required',
                'discount' => 'required|numeric|between:0,100',
                'start_time' => 'required|date_format:Y-m-d\TH:i|before:end_time',
                'end_time' => 'required|date_format:Y-m-d\TH:i|after:start_time',
                'menus' => 'required'
            ],
            [
                'name.required' => 'Name can\'t be empty!',
                'discount.required' => 'Discount can\'t be empty!',
                'discount.numeric' => 'Discount must be numeric!',
                'discount.between' => 'Discount out of range!',
                'start_time.required' => 'Start time can\'t be empty!',
                'start_time.date_format' => 'Start time must be a date!',
                'start_time.before' => 'Start time must be before end time!',
                'end_time.required' => 'End time can\'t be empty!',
                'end_time.date_format' => 'End time must be a date!',
                'end_time.after' => 'End time must be after start time!',
                'menus.required' => 'At least one menu must be selected!',
            ]
        );

        $existingPromos = Promo::all();
        foreach ($existingPromos as $existingPromo) {
            if (($request->start_time >= $existingPromo->start_time && $request->start_time <= $existingPromo->end_time) ||
                ($request->end_time >= $existingPromo->start_time && $request->end_time <= $existingPromo->end_time) ||
                ($existingPromo->start_time >= $request->start_time && $existingPromo->end_time <= $request->end_time)) {
                return redirect('/promo/create')->withErrors([
                    'start_time' => 'Promo time overlaps with existing promos.',
                    'end_time' => 'Promo time overlaps with existing promos.'
                ]);
            }
        }

        $promo = Promo::create([
            'name' => $request->name,
            'discount' => $request->discount,
            'start_time' => $request->start_time,
            'end_time' => $request->end_time,
            'is_active' => 0,
        ]);

        foreach ($request->menus as $menu) {
            PromoMenu::create([
                'promo_id' => $promo->id,
                'menu_id' => $menu,
                'original_price' => Menu::findOrFail($menu)->price
            ]);
        }

        return redirect('/promo');
    }
}
