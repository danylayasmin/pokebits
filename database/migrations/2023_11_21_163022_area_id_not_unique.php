<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('encounter_areas', function (Blueprint $table) {
            $table->dropUnique('encounter_areas_area_id_unique');
            $table->dropUnique('encounter_areas_area_name_unique');
        });
    }

    public function down(): void
    {
        Schema::table('encounter_areas', function (Blueprint $table) {
            $table->unique('area_id');
            $table->unique('area_name');
        });
    }
};
