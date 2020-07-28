<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlanRoleTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('plan_role', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('id_plan')->unsigned()->nullable();
            $table->foreign('id_plan')->references('id')->on('plan')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('id_role')->unsigned()->nullable();
            $table->foreign('id_role')->references('id')->on('role')->onUpdate('cascade')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('plan_role');
    }
}
