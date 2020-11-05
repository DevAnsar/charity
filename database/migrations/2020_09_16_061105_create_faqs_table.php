<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faqs', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->unsignedBigInteger('faq_category_id');
            $table->text('description')->nullable();//توضیحات مختصر
            $table->text('body')->nullable();//توضیح اجمالی
            $table->boolean('repetitive')->default(false);//پر تکرار
            $table->boolean('status')->default(true);

            $table->foreign('faq_category_id')->references('id')->on('faq_categories')->onDelete('cascade');
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
        Schema::dropIfExists('faqs');
    }
}
