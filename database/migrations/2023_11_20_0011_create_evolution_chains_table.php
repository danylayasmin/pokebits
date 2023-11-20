<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('evolution_chains', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pokemon_id');
            $table->json('evolution_chain')->nullable();
            $table->timestamps();

            $table->foreign('pokemon_id')->references('id')->on('pokemon');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('evolution_chains');
    }
};
