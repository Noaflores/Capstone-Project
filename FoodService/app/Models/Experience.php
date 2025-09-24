<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Experience extends Model
{
    protected $fillable = ['title','description','category_id',];
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
    /** @use HasFactory<\Database\Factories\ExperienceFactory> */
    use HasFactory;
}
