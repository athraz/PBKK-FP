<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;

    protected $table = "promos";
    protected $fillable = ["name", "discount", "start_time", "end_time"];

    public function promo_menu(){
        return $this->hasMany(PromoMenu::class);
    }
}
