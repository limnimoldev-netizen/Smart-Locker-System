<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (! Schema::hasTable('locations') || ! Schema::hasColumn('locations', 'map_url')) {
            return;
        }

        Schema::table('locations', function (Blueprint $table) {
            $table->text('map_url')->nullable()->change();
        });
    }

    public function down(): void
    {
        if (! Schema::hasTable('locations') || ! Schema::hasColumn('locations', 'map_url')) {
            return;
        }

        Schema::table('locations', function (Blueprint $table) {
            $table->string('map_url', 5000)->nullable()->change();
        });
    }
};