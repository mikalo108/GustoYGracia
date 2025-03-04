<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recipe extends Model
{
    use HasFactory;

    protected $table = 'recipes';
    protected $fillable = ['name', 'description', 'user_id', 'instructions', 'image'];


    /**
     * Relación inversa con ingredientes (N:N).
     */
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'recipe_ingredients')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    /**
     * Relación inversa con categorías (N:N).
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'recipe_categories')
            ->withTimestamps();
    }

    /**
     * Relación con comentarios (1:N).
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Relación con detalles (1:1).
     */
    public function details()
    {
        return $this->hasOne(RecipeDetail::class);
    }

    /**
     * Relación inversa con el usuario (1:N).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
