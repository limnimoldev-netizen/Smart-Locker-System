<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('lockers', function (Blueprint $table) {
            $table->string('locker_id', 20)->primary();
            $table->string('locker_code', 30)->unique();
            $table->string('location_id', 20)->index();
            $table->string('locker_type', 30)->default('Standard');
            $table->string('lock_type', 30)->default('Key');
            $table->string('access_method', 30)->default('Key');
            $table->string('status', 20)->default('Available')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('lockers');
    }
};
