<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stock extends Model
{
    use HasFactory;
    protected $fillable = ['supplier_id', 'product_id', 'stock_quantity','price_per_unit'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class,'supplier_id', 'user_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
    // Relationship to Unit model
    public function unit()
    {
        return $this->belongsTo(Unit::class);
    }
}
