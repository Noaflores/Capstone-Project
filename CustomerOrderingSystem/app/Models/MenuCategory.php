<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class MenuCategory extends Model
{
    use HasFactory;

    // Specify the table name (optional if it follows Laravel's naming convention)
    protected $table = 'menu_categories';

    // Specify the fields that can be filled (from your screenshot)
    protected $fillable = [
        'name',
        'description',
    ];
}
