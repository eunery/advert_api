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
            $table->boolean('isActive')->nullable();
            $table->string('tittle')->nullable();
            $table->string('location')->nullable();
            $table->float('price')->nullable();
            $table->string('paymentSchedule')->nullable();
            $table->string('size')->nullable();
            $table->string('place')->nullable();
            $table->string('text')->nullable();
            $table->string('shortText')->nullable();
            $table->string('user_created')->nullable();
            $table->string('user_accepted')->nullable();
            $table->dateTime('created_at')->default(now())->nullable();
            $table->dateTime('closed_at')->nullable()->nullable();
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
