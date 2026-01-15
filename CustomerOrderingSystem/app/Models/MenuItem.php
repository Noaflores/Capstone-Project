<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuItem extends Model
{
    use HasFactory;

    protected $table = 'menu_items';

    // Primary key = id (default in Laravel, but explicit is OK)
    protected $primaryKey = 'id';

    protected $fillable = [
        'id',   
        'sub_category_id',
        'name',
        'description',
        'price',
        'image_path',
        'is_available',
    ];

    public function subCategory()
    {
        return $this->belongsTo(SubCategory::class, 'sub_category_id');
    }
}
