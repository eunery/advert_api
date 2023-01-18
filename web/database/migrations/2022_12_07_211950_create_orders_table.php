<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
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
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // false - активно, не подверждено; true - активно, подверждено
            $table->boolean('is_confirmed')->default(false);
            $table->boolean('is_active')->default(true);
            $table->string('tittle')->nullable();
            $table->string('location')->nullable();
            $table->float('price')->nullable();
            $table->string('payment_schedule')->nullable();
            $table->string('size')->nullable();
            $table->string('place')->nullable();
            $table->string('text')->nullable();
            $table->string('short_text')->nullable();
            $table->unsignedBigInteger('user_created')->nullable();
            $table->foreign('user_created')->references('id')->on('users');
            $table->unsignedBigInteger('user_accepted')->nullable();
            $table->foreign('user_accepted')->references('id')->on('users');
            $table->dateTime('closed_at')->nullable();
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
        Schema::dropIfExists('orders');
    }
};
