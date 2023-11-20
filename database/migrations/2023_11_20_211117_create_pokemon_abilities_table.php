<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('pokemon_abilities', function (Blueprint $table) {
            $table->id();
            $table->string('pokemon');
            $table->string('ability');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('pokemon_abilities');
    }
};
