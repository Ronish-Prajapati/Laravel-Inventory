<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuotationDetail extends Model
{
    use HasFactory;
    public function quotation()
    {
        return $this->belongsTo(Quotation::class, 'quotation_id', 'id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id', 'id');
    }
}
