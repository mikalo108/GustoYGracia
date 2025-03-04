<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RecipeIngredient extends Model
{
    use HasFactory;

    protected $table = 'recipe_ingredients';

    //  Relación inversa 1:1 con una receta, la relación original es N:N, pero esta es la tabla de relación intermedia. 
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    //  Relación inversa 1:1 con un ingrediente, la relación original es N:N, pero esta es la tabla de relación intermedia. 
    public function ingredient() 
    {
        return $this->belongsTo(Ingredient::class);
    }
}
