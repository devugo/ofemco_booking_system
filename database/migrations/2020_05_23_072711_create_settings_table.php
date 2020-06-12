<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('carousel_image_1')->nullable();
            $table->string('carousel_image_2')->nullable();
            $table->string('carousel_image_3')->nullable();
            $table->string('statistics_one_name')->nullable();
            $table->string('statistics_one_value')->nullable();
            $table->string('statistics_two_name')->nullable();
            $table->string('statistics_two_value')->nullable();
            $table->string('statistics_three_name')->nullable();
            $table->string('carousel_three_value')->nullable();
            $table->string('logo')->nullable();
            $table->string('favicon')->nullable();
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
        Schema::dropIfExists('settings');
    }
}
