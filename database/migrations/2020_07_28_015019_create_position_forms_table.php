<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePositionFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('position_forms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_position')->unsigned()->nullable();
            $table->foreign('id_position')->references('id')->on('positions')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('id_form')->unsigned()->nullable();
            $table->foreign('id_form')->references('id')->on('forms')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('position_forms');
    }
}
