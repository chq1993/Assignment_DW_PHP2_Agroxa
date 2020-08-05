<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('roles', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_user')->unsigned()->nullable();
            $table->foreign('id_user')->references('id')->on('user')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('id_position')->unsigned()->nullable();
            $table->foreign('id_position')->references('id')->on('positions')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('id_division')->unsigned()->nullable();
            $table->foreign('id_division')->references('id')->on('divisions')->onUpdate('cascade')->onDelete('cascade');
            $table->boolean('status')->default(true);
            $table->float('percentageOfRole');
            $table->date('start_time');
            $table->date('end_time');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('roles');
    }
}
