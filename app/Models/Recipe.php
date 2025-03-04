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
     * Relación con ingredientes (muchos a muchos).
     */
    public function ingredients()
    {
        return $this->belongsToMany(Ingredient::class, 'recipe_ingredients')
            ->withPivot('quantity')
            ->withTimestamps();
    }

    /**
     * Relación con categorías (muchos a muchos).
     */
    public function categories()
    {
        return $this->belongsToMany(Category::class, 'recipe_categories')
            ->withTimestamps();
    }

    /**
     * Relación con comentarios (uno a muchos).
     */
    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Relación con detalles (uno a uno).
     */
    public function details()
    {
        return $this->hasOne(RecipeDetail::class);
    }

    /**
     * Relación con el usuario (uno a muchos inverso).
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
