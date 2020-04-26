<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateClientsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('last_name');
            $table->string('middle_name')->nullable();
            $table->date('birthday_at')->nullable();
            $table->string('city')->nullable();
            $table->string('street')->nullable();
            $table->string('house', 15)->nullable();
            $table->string('appartment', 15)->nullable();
            $table->string('email')->nullable();
            $table->string('phone');
            $table->unsignedBigInteger('cart_id')->nullable();
            $table->foreign('cart_id')->on('cart_storages')->references('id');
            $table->unsignedBigInteger('visitor_id')->index();
            $table->foreign('visitor_id')->on('visitors')->references('id');
            $table->timestamps();
            $table->softDeletes();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('clients');
    }
}
