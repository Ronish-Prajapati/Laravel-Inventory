<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
     
    protected $guarded = [];
    public function user(){
        return $this->belongsTo(User::class);
    }

    public function customer(){
        return $this->belongsTo(Customer::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    public function details(){
        return $this->hasMany(OrderDetail::class);
    }

    
}
