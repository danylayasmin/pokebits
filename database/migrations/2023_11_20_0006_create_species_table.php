<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('species', function (Blueprint $table) {
            $table->id();
            $table->string('pokemon_name');
            $table->text('description')->nullable();
            $table->json('types');
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
        });
    }

    public function down()
    {
        Schema::dropIfExists('species');
    }
};
