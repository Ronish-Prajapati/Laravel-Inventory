<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplier extends Model
{
    use HasFactory;
    protected $primaryKey = 'user_id';

    public $incrementing = false; // If user_id is not auto-incrementing
    protected $keyType = 'string'; // If user_id is not an integer
    protected $guarded=[];
    public function purchases()
    {
        return $this->hasMany(Purchase::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function products()
    {
        return $this->belongsToMany(Product::class, 'supplier_product', 'supplier_id', 'product_id')
                    ->withPivot('stock_quantity');
    }
    public function stocks()
    {
        return $this->hasMany(Stock::class,'supplier_id', 'user_id');
    }
}
