<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;

    protected $table = 'contacts';
    
    //  Relación 1:1 con un usuario
    public function user()
    {
        return $this->hasOne(User::class);
    }
}
