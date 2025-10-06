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

    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    public function getFormattedItemIdAttribute()
    {
    return 'I' . str_pad($this->id, 3, '0', STR_PAD_LEFT);
    }

    public function getFormattedOrderIdAttribute()
    {
    return 'ORD' . str_pad($this->order->id ?? 0, 2, '0', STR_PAD_LEFT);
    }

}
