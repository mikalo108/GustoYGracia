<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Comment extends Model
{
    use HasFactory;

    protected $table = 'comments';

    //  Relación inversa 1:1 con una receta
    public function recipe()
    {
        return $this->belongsTo(Recipe::class);
    }

    //  Relación inversa 1:1 con una usuario
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
