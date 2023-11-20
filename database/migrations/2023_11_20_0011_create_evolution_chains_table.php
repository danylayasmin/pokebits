<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::create('evolution_chains', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pokemon_id');
            $table->json('evolution_chain')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('evolution_chains');
    }
};
