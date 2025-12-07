<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $primaryKey = 'item_id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
        'item_id',
        'name',
        'description',
        'price',
        'image',
    ];

    public function orders()
    {
        return $this->hasMany(OrderItem::class, 'item_id', 'item_id');
    }
}
