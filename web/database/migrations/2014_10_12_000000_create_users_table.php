<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->boolean('is_admin')->default(false);
            $table->string('name');
            $table->string('second_name')->nullable();
            $table->string('surname')->nullable();
            $table->string('email')->unique()->nullable();
            $table->string('password')->nullable();
            $table->string('image')->nullable();
            $table->integer('activeOrders')->nullable();
            #$table->foreign('activeOrders')->references('id')->on('orders');
            $table->integer('placedOrders')->nullable();
            #$table->foreign('placedOrders')->references('id')->on('orders');
            $table->integer('vehicles')->nullable();
            #$table->foreign('vehicles')->references('id')->on('vehicles');
            $table->integer('historyVehicles')->nullable();
            #$table->foreign('historyVehicles')->references('id')->on('vehicles');
            $table->rememberToken()->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
};
