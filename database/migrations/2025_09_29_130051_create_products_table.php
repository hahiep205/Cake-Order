<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {

        /*
        *** Tạo bảng products.
        */
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('product_id');
            $table->string('product_name');
            $table->decimal('price', 10, 2);
            $table->integer('stock')->default(0);
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('products');
    }
};
