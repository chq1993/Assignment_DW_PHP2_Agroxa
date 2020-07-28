<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRoleFormRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('role_form_role', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('role_id_danhgia')->unsigned()->nullable();
            $table->foreign('role_id_danhgia')->references('id')->on('role')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('role_id_duocdanhgia')->unsigned()->nullable();
            $table->foreign('role_id_duocdanhgia')->references('id')->on('role')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('id_form')->unsigned()->nullable();
            $table->foreign('id_form')->references('id')->on('form')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('role_form_role');
    }
}
