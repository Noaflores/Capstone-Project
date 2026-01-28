<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SubCategory extends Model
{
    use HasFactory;

    // Use the correct table
    protected $table = 'menu_subcategories';

    // Define the fillable fields
    protected $fillable = ['category_id', 'name', 'description'];

    /**
     * Get the parent category of this subcategory
     */
    public function category()
    {
        return $this->belongsTo(MenuCategory::class, 'category_id');
    }

    /**
     * Get the items under this subcategory
     */
    public function items()
{
    return $this->hasMany(MenuItem::class, 'sub_category_id');
}
}
