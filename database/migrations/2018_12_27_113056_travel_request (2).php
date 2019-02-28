<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TravelRequest extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('travel_request', function (Blueprint $table) {
            $table->increments('id');
            
            $table->integer('trip_from_loc')->unsigned();
            $table->integer('trip_to_loc')->unsigned();
            
            $table->integer('travel_type')->unsigned();
            $table->integer('user')->unsigned();
            $table->date('start_date');
            $table->date('end_date');
            $table->unsignedTinyInteger('is_deleted')->default(0);
            $table->integer('status')->unsigned();

            $table->foreign('trip_from_loc')->references('id')->on('locations')->onDelete('cascade');
            $table->foreign('trip_to_loc')->references('id')->on('locations')->onDelete('cascade');
            $table->foreign('travel_type')->references('id')->on('travel_type')->onDelete('cascade');
            $table->foreign('user')->references('id')->on('user')->onDelete('cascade');
            $table->foreign('status')->references('id')->on('travel_status')->onDelete('cascade');
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
        Schema::dropIfExists('travel_request');
    }
}
