<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\OrderItem;

class Order extends Model
{
    use HasFactory;

    protected $primaryKey = 'order_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'user_id',
        'total',
        'status',
    ];

    // Relation to order items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'order_id');
    }

    // Accessor for formatted order ID (ORD01)
    public function getFormattedOrderIdAttribute()
    {
        return 'ORD' . str_pad($this->order_id, 2, '0', STR_PAD_LEFT);
    }
}
