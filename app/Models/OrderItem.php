<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    protected $fillable = [
        'order_id',
        'product_id',
        'quantity',
        'price',
    ];

    /**
     * Get the order
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Get the product
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Get subtotal for this item
     */
    public function getSubtotalAttribute(): int
    {
        return $this->price * $this->quantity;
    }

    public function getProductNameAttribute(): string
    {
        return $this->product ? $this->product->name : 'Deleted Product';
    }
}
