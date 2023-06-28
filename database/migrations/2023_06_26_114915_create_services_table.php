<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('services', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('number_of_tasks');
            $table->string('anual_time');
            $table->string('daily_service_date')->nullable();
            $table->string('weekly_service_date')->nullable();
            $table->string('monthly_service_date')->nullable();
            $table->string('daily_total_timing')->nullable();
            $table->string('weekly_total_timing')->nullable();
            $table->string('monthly_total_timing')->nullable();
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
        Schema::dropIfExists('services');
    }
}
