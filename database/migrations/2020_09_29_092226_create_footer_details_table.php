<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFooterDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('footer_details', function (Blueprint $table) {
            $table->id();
            $table->text('column_1')->nullable();
            $table->text('column_2')->nullable();
            $table->text('column_3')->nullable();
            $table->text('message')->nullable();
            $table->text('description')->nullable();
            $table->text('right')->nullable();
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
        Schema::dropIfExists('footer_details');
    }
}
