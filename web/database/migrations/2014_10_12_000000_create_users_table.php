<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->integer('user_type_id');
            $table->integer('event_id');
            $table->integer('country_id');
            $table->string('reg_number');
            $table->string('name');
            $table->string('email');
            $table->string('phone');
            $table->string('company');
            $table->string('custom_field_1');
            $table->string('custom_field_2');
            $table->string('custom_field_3');
            $table->boolean('need_login');
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
        Schema::dropIfExists('users');
    }
}
