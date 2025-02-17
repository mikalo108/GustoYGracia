<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ingredient extends Model
{
    use HasFactory;

    protected $table = 'ingredients';

    public function recipes()
    {
        return $this->belongsToMany(Recipe::class)
            ->withPivot('quantity')
            ->withTimestamps();
    }
}
