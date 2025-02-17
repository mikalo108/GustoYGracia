<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recipe extends Model
{
    use HasFactory;

    protected $table = 'recipes';

    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'recipe_ingredients', 'recipe_id', 'ingredient_id')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    public function categories() 
    {
        return $this->belongsToMany(Category::class, 'recipe_categories', 'recipe_id', 'category_id')
            ->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class, 'recipe_id');
    }

    public function details()
    {
        return $this->hasOne(RecipeDetail::class, 'recipe_id'); 
    }
}
