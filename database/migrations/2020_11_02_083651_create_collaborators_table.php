<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCollaboratorsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('collaborators', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('family');
            $table->string('code_melli');
            $table->string('tell');
            $table->string('mobile');
            $table->string('education_rate')->nullable();//میزان تحصیلات
            $table->string('field_of_Study')->nullable();//رشته ی تحصیلی
            $table->string('job')->nullable();
            $table->string('date_of_birth')->nullable();
            $table->text('address')->nullable();
            $table->string('type_of_cooperation')->nullable();
            $table->text('cooperation_time')->nullable();
            $table->boolean('seen')->default(0);
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
        Schema::dropIfExists('collaborators');
    }
}
