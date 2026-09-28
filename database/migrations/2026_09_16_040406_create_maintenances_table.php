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
        Schema::create('maintenances', function (Blueprint $table) {
            $table->string('maintenance_id')->primary();
            $table->string('locker_id');
            $table->string('location_id');
            $table->string('issue_type');
            $table->string('priority')->default('medium');
            $table->string('status')->default('open');
            $table->string('reported_by');
            $table->date('reported_at');
            $table->date('resolved_at')->nullable();
            $table->timestamps();

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('maintenances');
    }
};
