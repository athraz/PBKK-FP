<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = "menus";
    protected $fillable = ["name", "type_id", "price", "description", "photo"];

    public function type(){
        return $this->belongsTo(Type::class);
    }

    public function review(){
        return $this->hasMany(Review::class);
    }

    public function cart(){
        return $this->hasMany(Cart::class);
    }

    public function order_menu(){
        return $this->hasMany(OrderMenu::class);
    }
}
