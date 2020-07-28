<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionFormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_form', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_form')->unsigned()->nullable();
            $table->foreign('id_form')->references('id')->on('form')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('id_question')->unsigned()->nullable();
            $table->foreign('id_question')->references('id')->on('question')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_form');
    }
}
