<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePollingResponsesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('polling_responses', function (Blueprint $table) {
            $table->id();
            $table->integer('event_id');
            $table->integer('polling_id');
            $table->integer('polling_question_id');
            $table->integer('user_id');
            $table->string('uuid');
            $table->integer('polling_answer_id');
            $table->text('answer_text');
            $table->boolean('is_winner');
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
        Schema::dropIfExists('polling_responses');
    }
}
