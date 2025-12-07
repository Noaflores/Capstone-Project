<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
    Schema::create('menu_items', function (Blueprint $table) {
    $table->engine = 'InnoDB';
    $table->string('item_id')->primary(); // <-- use string primary key
    $table->string('name');
    $table->text('description')->nullable();
    $table->decimal('price', 8, 2);
    $table->string('image')->nullable();
    $table->timestamps();
});


    }

    public function down(): void
    {
        Schema::dropIfExists('menu_items');
    }
};
