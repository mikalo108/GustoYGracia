<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recipe extends Model
{
    use HasFactory;

    protected $table = 'recipes';
    protected $fillable = ['name', 'description', 'ingredients', 'instructions'];


    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'recipe_ingredients')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    public function categories() 
    {
        return $this->belongsToMany(Category::class, 'recipe_categories')
            ->withTimestamps();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function details()
    {
        return $this->hasOne(RecipeDetail::class); 
    }

    public function user() {
        return $this->belongsTo(User::class);
    }
}
