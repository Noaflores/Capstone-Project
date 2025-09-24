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
    Schema::table('event_schedules', function (Blueprint $table) {
        $table->date('date')->after('experience_id');
    });
}

public function down(): void
{
    Schema::table('event_schedules', function (Blueprint $table) {
        $table->dropColumn('date');
    });
}

};
