<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class RecipeDetail extends Model
{
    use HasFactory;

    protected $table = 'recipe_details';
    protected $fillable = ['recipe_id', 'prep_time', 'difficulty_level'];

    // Relación inversa 1:1 con receta
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
