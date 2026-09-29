<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        if (!Schema::hasTable('locations')) {
            return;
        }

        Schema::table('locations', function (Blueprint $table) {
            if (!Schema::hasColumn('locations', 'latitude')) {
                $table->string('latitude')->nullable();
            }
            if (!Schema::hasColumn('locations', 'longitude')) {
                $table->string('longitude')->nullable();
            }
        });
    }

    public function down(): void
    {
        if (!Schema::hasTable('locations')) {
            return;
        }

        Schema::table('locations', function (Blueprint $table) {
            $columnsToDrop = [];

            if (Schema::hasColumn('locations', 'latitude')) {
                $columnsToDrop[] = 'latitude';
            }
            if (Schema::hasColumn('locations', 'longitude')) {
                $columnsToDrop[] = 'longitude';
            }

            if (!empty($columnsToDrop)) {
                $table->dropColumn($columnsToDrop);
            }
        });
    }
};