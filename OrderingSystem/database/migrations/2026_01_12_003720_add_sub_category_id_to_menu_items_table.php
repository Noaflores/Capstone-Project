<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
{
    Schema::table('menu_items', function (Blueprint $table) {
        if (!Schema::hasColumn('menu_items', 'sub_category_id')) {
            $table->unsignedBigInteger('sub_category_id')->after('id');
        }
    });
}


public function down()
{
    Schema::table('menu_items', function (Blueprint $table) {
        $table->dropForeign(['sub_category_id']);
        $table->dropColumn('sub_category_id');
    });
}

};
