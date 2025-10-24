<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('order_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('order_id');
            
            // Product info snapshot
            $table->string('product_id', 50);
            $table->string('product_name', 255);
            $table->decimal('unit_price', 8, 2);
            $table->integer('quantity');
            $table->text('note')->nullable();
            $table->decimal('item_total', 10, 2);
            
            $table->timestamps();
            
            // Foreign key
            $table->foreign('order_id')->references('id')->on('orders')->onDelete('cascade');
            
            // Indexes
            $table->index('order_id');
            $table->index('product_id');
        });
    }

    public function down()
    {
        Schema::dropIfExists('order_items');
    }
};