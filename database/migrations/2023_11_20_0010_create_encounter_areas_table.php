<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('encounter_areas', function (Blueprint $table) {
            $table->id();
            $table->integer('area_id')->unique();
            $table->string('area_name')->unique();
            $table->string('pokemon_name');
            $table->string('method')->nullable();
            $table->integer('chance')->nullable();
            $table->timestamps();

            $table->foreign('pokemon_name')->references('name')->on('pokemon');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('encounter_areas');
    }
};
