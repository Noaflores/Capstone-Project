<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // If your primary key is "order_id" instead of "id":
    protected $primaryKey = 'order_id';

    // If the primary key is auto-incrementing:
    public $incrementing = true;

    // Type of primary key
    protected $keyType = 'int';

    protected $fillable = [
        'customer_id',
        'item_name',
        'quantity',
        'price',
        'total',
        'status', // add if you have a status column
    ];

    // Relation to order items
    public function orderItems()
{
    return $this->hasMany(OrderItem::class, 'order_id', 'id');
}

}
