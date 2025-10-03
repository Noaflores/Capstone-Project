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
    Schema::create('order_items', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('order_id');
        $table->string('item_id'); // matches menu_items.item_id
        $table->integer('quantity');
        $table->decimal('subtotal', 8, 2);
        $table->timestamps();

        // Foreign key to orders table
        $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');

        // Foreign key to menu_items table using string item_id
        $table->foreign('item_id')->references('item_id')->on('menu_items')->onDelete('cascade');
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
