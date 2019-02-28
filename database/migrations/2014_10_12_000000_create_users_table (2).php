<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::disableForeignKeyConstraints();
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('email')->unique();
            $table->timestamp('email_verified_at')->nullable();
            $table->string('phone_no');
            $table->string('cnic');
            $table->string('passport_no');
            $table->string('passport_attachment');
            $table->unsignedInteger('department_id')->index();
            $table->unsignedInteger('designation_id')->index();
            $table->string('password');
            $table->rememberToken();
            $table->unsignedInteger('created_by')->index();
            $table->unsignedInteger('updated_by')->index();


            $table->foreign('department_id')->references('id')->on('department')->onDelete('cascade');
            $table->foreign('designation_id')->references('id')->on('designation')->onDelete('cascade');

            $table->foreign('created_by')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('updated_by')->references('id')->on('users')->onDelete('cascade');
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
