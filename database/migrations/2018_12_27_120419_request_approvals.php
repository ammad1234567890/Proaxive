<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RequestApprovals extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('request_approvals', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('request_id')->unsigned();
            $table->integer('user_id')->unsigned();
            $table->string('comment');
            $table->integer('status')->unsigned();
            $table->foreign('status')->references('id')->on('travel_status')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('request_approvals');
    }
}
