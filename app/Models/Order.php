<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Order extends Model
{
    protected $fillable = [
        'order_number',
        'customer_id',
        'customer_name',
        'customer_phone',
        'customer_address',
        'notes',
        'status',
        'subtotal',
        'sale_id',
        'source',
        'whatsapp_sent_at',
        'confirmed_by',
        'confirmed_at',
    ];

    protected $casts = [
        'subtotal'           => 'float',
        'whatsapp_sent_at'   => 'datetime',
        'confirmed_at'       => 'datetime',
    ];

    public function customer(): BelongsTo
    {
        return $this->belongsTo(Customer::class);
    }

    public function items(): HasMany
    {
        return $this->hasMany(OrderItem::class)->orderBy('sort_order');
    }

    public function sale(): BelongsTo
    {
        return $this->belongsTo(Sale::class);
    }

    public function confirmedBy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'confirmed_by');
    }

    public function isPending(): bool
    {
        return $this->status === 'pending';
    }
}
