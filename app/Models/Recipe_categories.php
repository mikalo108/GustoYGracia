<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recipe_categories extends Model
{
    use HasFactory;

    protected $table = 'recipe_categories';

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
