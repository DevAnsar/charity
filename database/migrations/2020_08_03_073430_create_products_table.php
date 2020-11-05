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
            $table->unsignedBigInteger('category_id');
            $table->unsignedBigInteger('user_id');//store user
            $table->string('title');
            $table->string('title_en');
            $table->string('price');
            $table->string('discount')->default('0');
            $table->text('description');
            $table->string('score')->nullable();
            $table->string('scoreCount')->default('0');
            $table->string('commentCount')->default('0');
            $table->string('viewCount')->default('0');
            $table->string('saleCount')->default('0');
            $table->string('status')->default('1');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('products');
    }
}
