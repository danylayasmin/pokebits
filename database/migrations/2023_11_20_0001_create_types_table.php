<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('types', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->json('double_damage_from')->nullable();
            $table->json('double_damage_to')->nullable();
            $table->json('half_damage_from')->nullable();
            $table->json('half_damage_to')->nullable();
            $table->json('no_damage_from')->nullable();
            $table->json('no_damage_to')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('types');
    }
};
