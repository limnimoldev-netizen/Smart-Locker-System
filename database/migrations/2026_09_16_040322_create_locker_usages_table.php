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
        Schema::create('locker_usages', function (Blueprint $table) {
            $table->id('usage_id');
            $table->string('locker_id', 20)->index();
            $table->string('location_id', 20)->index();
            $table->string('user_id', 20)->index();
            $table->dateTime('check_in_time')->index();
            $table->dateTime('check_out_time')->nullable();
            $table->unsignedInteger('duration_minutes')->nullable();
            $table->unsignedInteger('action_count')->default(0);
            $table->string('last_action', 30)->nullable();
            $table->string('status', 20)->default('Active')->index();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('locker_usages');
    }
};
