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
        Schema::create('fractions', function (Blueprint $table) {
            $table->id();
            $table->smallInteger('month');                                         // Storing them as integer instead of varchar
            $table->char('profile');
            $table->float('fraction', 3);                                    // Assuming fractions are rounded up to 2 digits
            $table->unique(['month', 'profile'], 'month_profile_unique_index');     // Only one value per Month-Profile combination
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('fractions');
    }
};
