<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategoryTranslation extends Model
{
    use HasFactory;

    //  Relación inversa 1:1 con categoría
    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
