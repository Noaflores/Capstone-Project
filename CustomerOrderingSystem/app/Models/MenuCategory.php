<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    use HasFactory;

    public function subcategories() 
    {
        return $this->hasMany(SubCategory::class, 'category_id'); 
        // 'category_id' is the foreign key in menu_subcategories table
    }

    // Specify the table name (optional if it follows Laravel's naming convention)
    protected $table = 'menu_categories';

    // Specify the fields that can be filled (from your screenshot)
    protected $fillable = [
        'name',
        'description',
    ];
}
