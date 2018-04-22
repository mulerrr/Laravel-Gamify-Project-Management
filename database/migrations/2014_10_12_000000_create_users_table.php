<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if(!Schema::hasTable('users')){
            Schema::create('users', function (Blueprint $table) {
                $table->increments('id');
                $table->string('name');
                $table->string('username')->unique();
                $table->string('email')->unique();
                $table->string('status')->nullable();
                $table->string('position')->nullable();
                $table->string('description')->nullable();
                $table->string('avatar')->default('/images/avatar/dummy-profile-picture.jpg');
                $table->string('password');

                $table->integer('role_id')->unsigned()->default(1);
                //$table->foreign('role_id')->references('id')->on('roles');

                $table->rememberToken();
                $table->timestamps();
            });
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
