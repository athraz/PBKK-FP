<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Menu extends Model
{
    use HasFactory;

    protected $table = "menus";
    protected $fillable = ["nama", "jenis", "harga", "deskripsi", "foto"];

    public function jenis(){
        return $this->belongsTo(Jenis::class);
    }
}
