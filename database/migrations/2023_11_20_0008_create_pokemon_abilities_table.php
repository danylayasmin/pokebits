<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pokemon_abilities', function (Blueprint $table) {
            $table->id();
            $table->string('pokemon');
            $table->string('ability');
            $table->timestamps();

            $table->foreign('pokemon')->references('name')->on('pokemon');
            $table->foreign('ability')->references('name')->on('abilities');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pokemon_abilities');
    }
};
