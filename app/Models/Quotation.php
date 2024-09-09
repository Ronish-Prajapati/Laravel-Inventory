<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Quotation extends Model
{
    use HasFactory;

    public function customer(){
        return $this->belongsTo(Customer::class);
    }

    public function quotationDetails(){
        return $this->hasMany(QuotationDetail::class);
    }
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    protected $fillable = ['supplier_id', 'product_id', 'quantity', 'price_per_unit', 'status', 'valid_until'];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class,'supplier_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
