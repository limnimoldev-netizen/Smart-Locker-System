<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('locker_usages', function (Blueprint $table) {
            if (!Schema::hasColumn('locker_usages', 'ended_at')) {
                $table->timestamp('ended_at')->nullable()->after('started_at');
            }
        });
    }

    public function down(): void
    {
        Schema::table('locker_usages', function (Blueprint $table) {
            if (Schema::hasColumn('locker_usages', 'ended_at')) {
                $table->dropColumn('ended_at');
            }
        });
    }
};