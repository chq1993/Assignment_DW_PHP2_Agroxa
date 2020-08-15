<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultAssessmentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('result_assessments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_role_assess')->unsigned()->nullable();
            $table->foreign('id_role_assess')->references('id')->on('roles')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('id_question_forms')->unsigned()->nullable();
            $table->foreign('id_question_forms')->references('id')->on('question_forms')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('id_role_beassessed')->unsigned()->nullable();
            $table->foreign('id_role_beassessed')->references('id')->on('roles')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('id_plan')->unsigned()->nullable();
            $table->foreign('id_plan')->references('id')->on('plans')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('id_answer_questions')->unsigned()->nullable();
            $table->foreign('id_answer_questions')->references('id')->on('answer_questions')->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('result_assessments');
    }
}
