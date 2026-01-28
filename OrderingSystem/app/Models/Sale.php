<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';
    protected $fillable = [
        'order_item_id',
        'user_id',
        'item_id',
        'item_name',
        'quantity',
        'price',
        'subtotal',
    ];
}
