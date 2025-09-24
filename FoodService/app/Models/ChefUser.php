<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChefUser extends Model
{
    protected $fillable = ['name','email','role','specialty','chef_title','favorite_dish','quote','teaching_years',];
    /** @use HasFactory<\Database\Factories\ChefUserFactory> */
    use HasFactory;
}
