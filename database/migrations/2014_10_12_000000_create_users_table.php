<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
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
            $table->string('name');
            $table->string('family');

//            $table->timestamp('email_verified_at')->nullable();
//            $table->string('password');
            $table->string('mobile')->unique();
            $table->string('loginCode')->nullable();
            $table->string('email')->nullable();
            $table->string('code_melli')->nullable();
            $table->string('shaba_number')->nullable();
            $table->string('bank_cart')->nullable();
            $table->string('email')->unique();
            $table->boolean('needy')->default(false);
            $table->boolean('hasNeedy')->default(false);
            $table->rememberToken();
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
}
