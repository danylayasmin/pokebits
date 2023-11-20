<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('encounter_areas', function (Blueprint $table) {
            $table->id();
            $table->integer('area_id');
            $table->string('area_name');
            $table->string('pokemon_name');
            $table->string('method')->nullable();
            $table->integer('chance')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('encounter_areas');
    }
};
