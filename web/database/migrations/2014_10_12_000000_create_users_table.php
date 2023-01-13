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
            $table->boolean('isAdmin')->default(false);
            $table->string('name');
            $table->string('second_name');
            $table->string('surname');
            $table->string('email')->unique();
            $table->string('password');
            $table->string('image');
            $table->foreign('activeOrders')->references('id')->on('orders');
            $table->foreign('placedOrders')->references('id')->on('orders');
            $table->foreign('vehicles')->references('id')->on('vehicles');
            $table->foreign('historyVehicles')->references('id')->on('vehicles');
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
