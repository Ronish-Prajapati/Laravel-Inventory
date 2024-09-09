<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;
    protected $guarded = [];
    
    public function orders(){
        return $this->hasMany(Order::class);
    }

    public function quotations(){
        return $this->hasMany(Quotation::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
}
