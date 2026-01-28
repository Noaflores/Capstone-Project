<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    protected $primaryKey = 'order_id'; // Primary key is not 'id'
    
    // Add all fields that can be mass-assigned
     protected $fillable = [
        'user_id',
        'payment_method',
        'total',
        'status',
        'gcash_name',
        'gcash_number',
    ];

    public $timestamps = true;

    // Relationship: One order has many order items
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'order_id', 'order_id');
    }

    // Relation to customer
    public function customer()
    {
        return $this->belongsTo(Customer::class, 'user_id', 'customer_id');
    }
}
