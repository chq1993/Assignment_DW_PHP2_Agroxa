<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_role_form_role')->unsigned()->nullable();
            $table->foreign('id_role_form_role')->references('id')->on('role_form_roles')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('id_question')->unsigned()->nullable();
            $table->foreign('id_question')->references('id')->on('questions')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('answer');
            $table->string('noidungdanhgia',255);
            $table->integer('id_plan');
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
        Schema::dropIfExists('results');
    }
}
