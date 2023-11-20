<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('moves', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('accuracy');
            $table->integer('effect_chance')->nullable();
            $table->integer('pp');
            $table->integer('priority')->nullable();
            $table->integer('power')->nullable();
            $table->string('type');
            $table->timestamps();

            $table->foreign('type')->references('name')->on('types');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('moves');
    }
};
