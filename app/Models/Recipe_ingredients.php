<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recipe_ingredients extends Model
{
    use HasFactory;

    protected $table = 'recipe_ingredients';

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    public function ingredient() 
    {
        return $this->belongsTo(Ingredient::class);
    }
}
