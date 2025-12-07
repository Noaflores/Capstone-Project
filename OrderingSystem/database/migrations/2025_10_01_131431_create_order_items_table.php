<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('order_item_id');

            $table->unsignedBigInteger('order_id'); // match orders.order_id type
            $table->string('item_id', 20);  // match menu_items.item_id type

            $table->integer('quantity');
            $table->decimal('price', 8, 2);
            $table->timestamps();

            // Foreign keys
            $table->foreign('order_id')
                  ->references('order_id')
                  ->on('orders')
                  ->onDelete('cascade');

            $table->foreign('item_id')
                  ->references('item_id')
                  ->on('menu_items')
                  ->onDelete('cascade');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};
