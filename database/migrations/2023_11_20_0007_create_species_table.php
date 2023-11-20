<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('species', function (Blueprint $table) {
            $table->id();
            $table->string('pokemon_name');
            $table->text('description')->nullable();
            $table->string('color_name');
            $table->string('color_hex');
            $table->string('shape');
            $table->integer('base_happiness');
            $table->integer('capture_rate');
            $table->string('habitat');
            $table->integer('growth_rate');
            $table->boolean('is_baby');
            $table->boolean('is_legendary');
            $table->boolean('is_mythical');
            $table->timestamps();

            $table->foreign('habitat')->references('name')->on('habitats');
            $table->foreign('pokemon_name')->references('name')->on('pokemon');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('species');
    }
};
