<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRSVPSTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('r_s_v_p_s', function (Blueprint $table) {
            $table->id();
            $table->integer('event_id');
            $table->integer('user_id');
            $table->string('seat_number');
            $table->integer('guest_qty');
            $table->integer('confirm_status'); // 0 = no confirmation, 1 = will present, 2 = won't present, 3 = won't present & update location
            $table->string('session_invitation');
            $table->string('event_time');
            $table->string('address_location');
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
        Schema::dropIfExists('r_s_v_p_s');
    }
}
