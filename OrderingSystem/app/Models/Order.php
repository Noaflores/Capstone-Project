<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
public function up()
{
    Schema::create('orders', function (Blueprint $table) {
        $table->id();
        $table->unsignedBigInteger('customer_id');
        $table->string('item_name');
        $table->integer('quantity');
        $table->decimal('price', 8, 2);
        $table->decimal('total', 8, 2);
        $table->timestamps();
    });
}

}
