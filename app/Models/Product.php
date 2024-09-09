<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;

class Product extends Model
{
    use HasFactory;
    protected  $guarded =[];

    public function suppliers()
    {
        
         return $this->belongsToMany(Supplier::class, 'supplier_product')
                    ->withPivot('stock_quantity');
    }

    public function category(){
        return $this->belongsTo(Category::class);
    }
    public function unit(){
        return $this->belongsTo(Unit::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function stocks()
    {
        return $this->hasMany(Stock::class);
    }
}
