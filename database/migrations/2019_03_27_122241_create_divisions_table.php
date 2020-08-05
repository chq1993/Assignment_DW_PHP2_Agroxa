<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDivisionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('divisions', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name_division', 255);
            $table->string('description_division', 500);
            $table->string('kind_division', 100);
            $table->integer('parent_id_division')->unsigned()->nullable();
            $table->foreign('parent_id_division')->references('id')->on('divisions')->onUpdate('cascade')->onDelete('cascade');
            $table->integer('division_level');
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
        Schema::dropIfExists('divisons');
    }
}
