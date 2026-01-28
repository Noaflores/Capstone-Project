<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MenuSubcategory extends Model
{
    protected $table = 'menu_subcategories';

    protected $fillable = [
        'category_id',
        'name',
        'description'
    ];
}
