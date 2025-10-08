<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = [
        'order_id',
        'item_id',
        'item_name',
        'quantity',
        'subtotal',
    ];

    /**
     * Relationship: OrderItem belongs to an Order
     */
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    /**
     * Accessor for formatted item ID (e.g., I001)
     */
    public function getFormattedItemIdAttribute()
    {
        return 'I' . str_pad($this->id, 3, '0', STR_PAD_LEFT);
    }

    /**
     * Accessor for formatted order ID (e.g., ORD01)
     */
    public function getFormattedOrderIdAttribute()
    {
        // Ensure we have a related order before accessing ID
        $orderId = $this->order->id ?? $this->order_id ?? 0;
        return 'ORD' . str_pad($orderId, 2, '0', STR_PAD_LEFT);
    }
}
