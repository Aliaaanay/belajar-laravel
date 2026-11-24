<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Order extends Model
{
    protected $table = 'orders';

    protected $fillable = [
        'invoice_code',
        'product_id',
        'qty',
        'discount_percent',
        'shipping_cost',
        'total_price',
        'status',
    ];

    protected $casts = [
        'qty' => 'integer',
        'discount_percent' => 'float',
        'shipping_cost' => 'float',
        'total_price' => 'float',
    ];

    /**
     * Relasi ke produk yang dipesan
     */
    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    /**
     * Helper untuk format rupiah total
     */
    public function getFormattedTotalAttribute(): string
    {
        return 'Rp ' . number_format($this->total_price, 0, ',', '.');
    }
}
