<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    protected $table = 'contact';
    public function user()
    {
        return $this->belongsTo('App\Models\User');
    }
}
