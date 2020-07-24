<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateObjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('object', function (Blueprint $table) {
            $table->increments('id')->unsigned();
            $table->integer('parent_id')->unsigned()->nullable();
            $table->foreign('parent_id')->references('id')->on('object')->onUpdate('cascade')->onDelete('cascade');
            $table->string('object_code',50)->unique();
            $table->string('object_url',500)->nullable();
            $table->string('object_name',100)->nullable();
            $table->string('description',500)->nullable();
            $table->integer('object_level');
            $table->integer('status');
            $table->integer('show_menu');
            $table->string('created_by',50);
            $table->string('updated_by',50);
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
        Schema::dropIfExists('object');
    }
}
