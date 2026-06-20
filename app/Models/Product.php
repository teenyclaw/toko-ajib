<?php
// app/Models/Product.php  — update fillable
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'barcode', 'category_id',
        'harga_beli_dus', 'qty_per_dus',
        'margin_dus',     'margin_dus_type',
        'margin_pcs',     'margin_pcs_type',
        'harga_jual_dus', 'harga_jual_pcs',
        // Harga non-pelanggan
        'margin_nonmember_dus',  'margin_nonmember_dus_type',
        'margin_nonmember_pcs',  'margin_nonmember_pcs_type',
        'harga_nonmember_dus',   'harga_nonmember_pcs',
        'stock',
        'is_orderable',
    ];

    protected $casts = [
        'is_orderable' => 'boolean',
    ];

    public function orders()
    {
        return $this->hasMany(OrderItem::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
