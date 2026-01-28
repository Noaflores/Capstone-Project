<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $table = 'order_items';
    protected $primaryKey = 'order_item_id';
    public $incrementing = true;
    protected $keyType = 'int';

    protected $fillable = [
        'order_id',
        'item_id',
        'menu_item_id',
        'item_name',
        'quantity',
        'price',
        'subtotal',
        'status'
    ];

    // Relation to parent order
   // OrderItem.php
public function order()
{
    return $this->belongsTo(Order::class, 'order_id', 'order_id');
}

}
