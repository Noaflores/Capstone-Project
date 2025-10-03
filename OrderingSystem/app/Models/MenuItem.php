<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    protected $primaryKey = 'item_id';   // since your PK is item_id
    public $incrementing = false;        // because item_id is a string like M001
    protected $keyType = 'string';

    protected $fillable = [
        'item_id', 'name', 'description', 'image', 'price',
    ];

    // ✅ Relationship to order_items
    public function orders()
    {
        return $this->hasMany(OrderItem::class, 'item_id', 'item_id');
    }
}
