<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PromoMenu extends Model
{
    use HasFactory;

    protected $table = "promo_menu";
    protected $fillable = ["promo_id", "menu_id"];

    public function promo(){
        return $this->belongsTo(Promo::class);
    }

    public function menu(){
        return $this->belongsTo(Menu::class);
    }
}
