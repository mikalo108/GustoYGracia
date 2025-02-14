<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Recipe_details extends Model
{
    use HasFactory;

    protected $table = 'recipe_details';

    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }
}
