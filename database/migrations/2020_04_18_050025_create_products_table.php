<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('products', function (Blueprint $table) {
            $table->id();
            $table->string('title')->nullable();
            $table->unsignedBigInteger('parent_id')->default(0)->index();
            $table->unsignedBigInteger('category_id')->index();
            $table->foreign('category_id')->on('categories')->references('id')->onDelete('cascade');
            $table->string('image')->nullable();
            $table->integer('price')->default(0);
            $table->text('text')->nullable();
            $table->integer('size')->nullable();
            $table->boolean('status')->default(true);
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
        Schema::dropIfExists('products');
    }
}
