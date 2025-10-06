<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        // ✅ SQLite doesn’t allow altering constraints directly, so we rebuild the column safely
        if (Schema::hasColumn('orders', 'status')) {
            // Rename the existing column to avoid "duplicate column" error
            Schema::table('orders', function (Blueprint $table) {
                $table->renameColumn('status', 'old_status');
            });
        }

        // Now add the new column with proper check constraint
        Schema::table('orders', function (Blueprint $table) {
            $table->string('status')
                  ->default('Pending')
                  ->check("status IN ('Pending', 'In Progress', 'Completed')")
                  ->nullable();
        });

        // ✅ Copy the old status values into the new column
        if (Schema::hasColumn('orders', 'old_status')) {
            DB::statement("UPDATE orders SET status = old_status");
        }

        // ✅ Drop the old column now that data is copied
        Schema::table('orders', function (Blueprint $table) {
            if (Schema::hasColumn('orders', 'old_status')) {
                $table->dropColumn('old_status');
            }
        });
    }

    public function down(): void
    {
        // Rollback logic (revert to only two allowed statuses)
        if (Schema::hasColumn('orders', 'status')) {
            Schema::table('orders', function (Blueprint $table) {
                $table->renameColumn('status', 'old_status');
            });

            Schema::table('orders', function (Blueprint $table) {
                $table->string('status')
                      ->default('Pending')
                      ->check("status IN ('Pending', 'Completed')")
                      ->nullable();
            });

            DB::statement("UPDATE orders SET status = old_status");
            Schema::table('orders', function (Blueprint $table) {
                $table->dropColumn('old_status');
            });
        }
    }
};
