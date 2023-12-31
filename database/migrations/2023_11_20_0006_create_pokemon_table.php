<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('pokemon', function (Blueprint $table) {
            $table->id();
            $table->integer('pokemon_id')->unique();
            $table->string('name')->unique();
            $table->string('sprite_front');
            $table->string('sprite_back');
            $table->string('artwork');
            $table->integer('stat_hp');
            $table->integer('stat_attack');
            $table->integer('stat_defense');
            $table->integer('stat_special_attack');
            $table->integer('stat_special_defense');
            $table->integer('stat_speed');
            $table->integer('height');
            $table->integer('weight');
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pokemon');
    }
};
