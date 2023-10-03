<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Jenis extends Model
{
    use HasFactory;

    protected $table = "jeniss";
    protected $fillable = ["nama"];

    public function menu(){
        return $this->hasMany(Menu::class);
    }
}
