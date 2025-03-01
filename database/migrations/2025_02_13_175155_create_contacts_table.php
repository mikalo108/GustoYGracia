<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('contacts', function (Blueprint $table) {
            $table->id();
            $table->string('name', 100)->nullable();
            $table->string('surname', 100)->nullable();  // Hacer nullable
            $table->string('bio', 2000)->nullable();     // Hacer nullable
            $table->string('phone', 20)->nullable();      // Hacer nullable
            $table->string('country', 100)->nullable();   // Hacer nullable
            $table->string('city', 100)->nullable();      // Hacer nullable
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('contacts');
    }
};
