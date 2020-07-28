<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionFormsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_forms', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_form')->unsigned()->nullable();
            $table->foreign('id_form')->references('id')->on('forms')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('question_forms');
    }
}
