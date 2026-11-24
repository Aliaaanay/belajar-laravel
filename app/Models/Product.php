<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Product extends Model
{
    protected $table = 'products';

    protected $fillable = [
        'sku',
        'name',
        'category',
        'price',
        'stock',
        'description',
    ];

    protected $casts = [
        'price' => 'float',
        'stock' => 'integer',
    ];

    /**
     * Relasi ke transaksi pesanan
     */
    public function orders(): HasMany
    {
        return $this->hasMany(Order::class, 'product_id');
    }

    /**
     * Helper untuk format rupiah
     */
    public function getFormattedPriceAttribute(): string
    {
        return 'Rp ' . number_format($this->price, 0, ',', '.');
    }

    /**
     * Cek apakah stok tersedia
     */
    public function isAvailable(): bool
    {
        return $this->stock > 0;
    }
}
