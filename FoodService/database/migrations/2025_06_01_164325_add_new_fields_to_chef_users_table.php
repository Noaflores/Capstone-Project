<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('chef_users', function (Blueprint $table) {
            $table->string('chef_title')->nullable();
            $table->string('favorite_dish')->nullable();
            $table->text('quote')->nullable();
            $table->integer('teaching_years')->nullable();
        });
    }

    public function down()
    {
        Schema::table('chef_users', function (Blueprint $table) {
            $table->dropColumn(['chef_title', 'favorite_dish', 'quote', 'teaching_years']);
        });
    }
};

