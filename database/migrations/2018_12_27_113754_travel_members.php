<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class TravelMembers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('travel_members', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('travel_id')->unsigned();
            $table->integer('user_member_id')->unsigned();
            $table->unsignedTinyInteger('is_deleted')->default(0);
            $table->foreign('travel_id')->references('id')->on('travel_request')->onDelete('cascade');
            $table->foreign('user_member_id')->references('id')->on('user_members')->onDelete('cascade');
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
        Schema::dropIfExists('travel_members');
    }
}
