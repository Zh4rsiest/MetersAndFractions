<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('meter_readings', function (Blueprint $table) {
            $table->id();                                   // Added an ID column in case data needs to be joined. Joining by integer is exponentially faster than joining by varchar
            $table->string('meter_id');             // Stored as varchar because of the leading zeros
            $table->char('profile');
            $table->smallInteger('month');          // Storing them as integer instead of varchar
            $table->integer('meter_reading');       // Assuming consumption shouldn't be more than 4 bytes
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('meter_readings');
    }
};
