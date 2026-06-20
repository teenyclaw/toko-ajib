<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StoreSetting extends Model
{
    protected $fillable = [
        'store_name',
        'store_whatsapp',
        'catalog_share_message',
    ];

    public static function current(): self
    {
        return static::firstOrCreate([], [
            'store_name'            => 'Toko Ajib',
            'catalog_share_message' => 'Halo! Silakan pesan produk kami melalui link berikut:',
        ]);
    }
}
