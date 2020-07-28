<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnswerQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('answer_questions', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_answer')->unsigned()->nullable();
            $table->foreign('id_answer')->references('id')->on('answers')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('id_question')->unsigned()->nullable();
            $table->foreign('id_question')->references('id')->on('questions')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('answer_questions');
    }
}
