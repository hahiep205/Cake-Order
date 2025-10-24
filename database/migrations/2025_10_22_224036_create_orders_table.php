<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('order_number', 20)->unique();
            
            // User reference
            $table->unsignedBigInteger('user_id');

            $table->string('customer_name', 100);
            $table->string('customer_phone', 15);
            $table->text('customer_address');
            
            // Order info
            $table->decimal('total_amount', 10, 2);
            $table->enum('payment_method', ['COD', 'Banking']);
            $table->enum('status', ['Pending', 'Processing', 'Completed', 'Cancelled'])
                  ->default('Pending');
            
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict');
            
            // Indexes
            $table->index(['user_id', 'created_at']);
            $table->index('order_number');
            $table->index('status');
        });
    }

    public function down()
    {
        Schema::dropIfExists('orders');
    }
};