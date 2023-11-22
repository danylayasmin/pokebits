<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('moves', function (Blueprint $table) {
            $table->integer('accuracy')->nullable()->change();
            $table->integer('effect_chance')->nullable()->change();
            $table->integer('pp')->nullable()->change();
            $table->integer('priority')->nullable()->change();
            $table->integer('power')->nullable()->change();
        });
    }

    public function down(): void
    {
        Schema::table('', function (Blueprint $table) {
            $table->integer('accuracy')->change();
            $table->integer('effect_chance')->change();
            $table->integer('pp')->change();
            $table->integer('priority')->change();
            $table->integer('power')->change();
        });
    }
};
