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
    Schema::create('menu_items', function (Blueprint $table) {
        $table->string('item_id')->primary();   // use this instead of id()
        $table->string('name');
        $table->text('description')->nullable();
        $table->string('image')->nullable();
        $table->decimal('price', 8, 2);
        $table->timestamps();
    });
}

public function down()
{
    Schema::dropIfExists('menu_items');
}

};
