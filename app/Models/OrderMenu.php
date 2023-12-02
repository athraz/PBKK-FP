<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderMenu extends Model
{
    use HasFactory;
    
    protected $table = "order_menu";
    protected $fillable = ["order_id", "menu_id", "quantity", "order_price"];

    public function order(){
        return $this->belongsTo(Order::class);
    }

    public function menu(){
        return $this->belongsTo(Menu::class);
    }
}
