<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SaleItem extends Model
{
    protected $fillable = [
    'sale_id',
    'product_id',
    'name',
    'qty',
    'price',
    'total'
];

public function product()
{
    return $this->belongsTo(\App\Models\Product::class);
}
}
