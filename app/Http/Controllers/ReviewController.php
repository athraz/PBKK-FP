<?php

namespace App\Http\Controllers;

use App\Models\Menu;
use App\Models\Review;
use App\Models\Type;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ReviewController extends Controller
{
    public function store(Request $request, $id)
    {
        $request->validate(
            [
                'rating' => 'gt:0',
                'message' => 'required'
            ],
            [
                'rating.gt'=> 'Please select menu\'s rating!',
                'message.required' => 'Message can\'t be empty!'
            ]
        );
        Review::create([
            'rating' => $request->rating,
            'message' => $request->message,
            'menu_id' => $id,
            'user_id' => Auth::user()->id
        ]);
        
        return redirect()->route('menu.show', ['id' => $id]);
    }
}
