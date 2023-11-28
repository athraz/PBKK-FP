<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    
    protected $table = "orders";
    protected $fillable = ["user_id", "total_price", "payment_method", "address", "status", "employee_id"];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function employee(){
        return $this->belongsTo(User::class);
    }

    public function orderMenu(){
        return $this->hasMany(OrderMenu::class);
    }
}
