<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Review extends Model
{
    use HasFactory;

    protected $table = "reviews";
    protected $fillable = ["rating", "message", "user_id", "menu_id"];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function menu(){
        return $this->belongsTo(Menu::class);
    }
}
