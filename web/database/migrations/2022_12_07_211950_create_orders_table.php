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
            // 0 - не активно 1 - активно, не подверждено 2 - активно, подверждено
            $table->integer('status')->default(0);
            $table->string('tittle')->nullable();
            $table->string('location')->nullable();
            $table->float('price')->nullable();
            $table->string('paymentSchedule')->nullable();
            $table->string('size')->nullable();
            $table->string('place')->nullable();
            $table->string('text')->nullable();
            $table->string('shortText')->nullable();
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
