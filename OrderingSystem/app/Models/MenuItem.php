<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $primaryKey = 'id';
    public $incrementing = false;
    protected $keyType = 'string';

    protected $fillable = [
    'name',
    'sub_category_id',
    'description',
    'price',
    'image_path',
    'is_available',
];


    public $timestamps = false;
    
    public function orders()
    {
        return $this->hasMany(OrderItem::class, 'id', 'id');
    }
}
