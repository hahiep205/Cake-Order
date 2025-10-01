<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{

    public function up()
    {

        /*
        *** Tạo table users
        */
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('name', 50)->nullable();
            $table->string('email', 50)->unique();
            $table->string('password');
            $table->string('phone', 10)->nullable();
            $table->text('address')->nullable();
            $table->enum('role', ['user', 'admin'])->default('user');
            $table->string('session_token')->nullable()->unique();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('users');
    }
};