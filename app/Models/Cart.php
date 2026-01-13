<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = [
        'user_id',
        'status',
    ];

    /**
     * Get cart owner
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Get cart items
     */
    public function items()
    {
        return $this->hasMany(CartItem::class);
    }

    /**
     * Get total price of cart
     */
    public function getTotalAttribute(): int
    {
        return $this->items->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });
    }

    /**
     * Get total items count
     */
    public function getItemCountAttribute(): int
    {
        return $this->items->sum('quantity');
    }
}
