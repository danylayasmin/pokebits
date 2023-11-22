<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pokemon', function (Blueprint $table) {
            $table->string('sprite_front')->nullable()->change();
            $table->string('sprite_back')->nullable()->change();
            $table->string('artwork')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pokemon');
    }
};
