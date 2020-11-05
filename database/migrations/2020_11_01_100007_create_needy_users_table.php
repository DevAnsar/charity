<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNeedyUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('needy_users', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->string('code_melli');
            $table->unsignedInteger('discount_percent')->default(0);
            $table->string('charge_inventory')->nullable();
            $table->string('date_of_birth');
            $table->unsignedInteger('state_id');
            $table->unsignedInteger('city_id');
            $table->boolean('is_married');
            $table->unsignedInteger('number_of_child')->default(0);
            $table->boolean('is_employed');
            $table->string('health_status');
            $table->string('covered');
            $table->string('housing_situation');
            $table->string('tell');
            $table->text('address');
            $table->text('evidence');

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
        Schema::dropIfExists('needy_users');
    }
}
