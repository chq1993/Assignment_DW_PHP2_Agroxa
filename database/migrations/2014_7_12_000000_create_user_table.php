<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username',50)->unique();
            $table->string('fullname',100);
            $table->string('address', 200)->nullable();
            $table->string('email', 50)->nullable();
            $table->date('birthday')->nullable();
            $table->string('phone', 20)->nullable();
            $table->string('password',255);
            $table->integer('status');
            $table->integer('user_type');
            $table->integer('current_role');
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
        Schema::dropIfExists('user');
    }
}
