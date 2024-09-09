<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Purchase extends Model
{
    use HasFactory;

    public function supplier(){
        return $this->belongsTo(Supplier::class);
    }
    public function details(){
        return $this->hasMany(PurchaseDetail::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    public function quotation()
    {
        return $this->belongsTo(Quotation::class);
    }
}
