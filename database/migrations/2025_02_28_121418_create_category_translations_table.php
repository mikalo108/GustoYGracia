<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCategoryTranslationsTable extends Migration
{
    public function up()
    {
        Schema::create('category_translations', function (Blueprint $table) {
            $table->id();
            $table->foreignId('category_id')->constrained()->onDelete('cascade');  // Relación con categories
            $table->string('locale');  // Idioma de la traducción
            $table->string('name');  // Traducción del nombre de la categoría
            $table->text('description');  // Traducción de la descripción
            $table->timestamps();

            $table->unique(['category_id', 'locale']);  // Asegura que cada categoría tenga una traducción única por idioma
        });
    }

    public function down()
    {
        Schema::dropIfExists('category_translations');
    }
}
