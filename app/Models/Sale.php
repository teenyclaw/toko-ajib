<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\SaleItem;

class Sale extends Model
{

public function customer()
{
    return $this->belongsTo(\App\Models\Customer::class);
}
 public function items()
{
    return $this->hasMany(\App\Models\SaleItem::class);
}   

// Sale.php
protected $fillable = ['invoice', 'total', 'paid', 'change', 'customer_id'];


}
