<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'categories';

    // Relación con las traducciones (1:N)
    public function translations()
    {
        return $this->hasMany(CategoryTranslation::class);
    }

     // Método para obtener la traducción en el idioma actual
     public function getNameAttribute()
     {
         $locale = app()->getLocale();  // Obtiene el idioma actual
         $translation = $this->translations->where('locale', $locale)->first();
 
         return $translation ? $translation->name : null;
     }
 
     // Método para obtener la traducción en el idioma actual
     public function getDescriptionAttribute()
     {
         $locale = app()->getLocale();  // Obtiene el idioma actual
         $translation = $this->translations->where('locale', $locale)->first();
 
         return $translation ? $translation->description : null;
     }

    //  Relación N:N con recetas
    public function recipes()
    {
        return $this->belongsToMany(Recipe::class, 'recipe_categories')
            ->withTimestamps();
    }
    
}
