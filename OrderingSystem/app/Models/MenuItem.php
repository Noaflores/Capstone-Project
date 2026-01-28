<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $table = 'menu_items';
    protected $primaryKey = 'id';
    public $incrementing = true; // or false if your IDs are strings
    protected $keyType = 'int'; // change to 'string' if using string IDs

    protected $fillable = [
        'name',
        'sub_category_id',
        'description',
        'price',
        'image_path',
        'is_available',
        'item_type',
    ];

    public $timestamps = false;

    // Relationship to SubCategory
    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id', 'id');
    }

    // Relationship to OrderItem
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class, 'menu_item_id', 'id');
    }
}
