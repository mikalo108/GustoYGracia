<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ingredient extends Model
{
    use HasFactory;

    protected $table = 'ingredients';
    protected $fillable = ['name', 'description', 'calories_per_100g'];

    //  Relación inversa N:N con una receta
    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'recipe_ingredients')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    public static function findOrCreate($attributes)
    {
        return static::firstOrCreate($attributes);
    }
}
