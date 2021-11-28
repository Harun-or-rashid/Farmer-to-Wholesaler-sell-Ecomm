<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->string('type', 64)->comment('type of user');
            $table->string('role',64)->comment('user role id');
            $table->string('username', 128)->nullable();
            $table->string('mobile', 128)->nullable();
            $table->string('email', 128)->unique();
            $table->string('password', 255);
            $table->string('first_name', 128)->nullable();
            $table->string('last_name', 128)->nullable();
            $table->string('profile_picture', 225)->nullable();
            $table->date('dob')->nullable()->comment('user birth date');
            $table->tinyInteger('gender')->nullable()->comment('1=male,2=female,3=other');
            $table->timestamp('email_verified_at')->nullable();
            $table->rememberToken();

            $table->unsignedTinyInteger('status')->default(0)->comment('0=Inactive,1=Active');

            $table->timestamp('created_at')->nullable();
            $table->unsignedInteger('created_by')->nullable();

            $table->timestamp('updated_at')->nullable();
            $table->unsignedInteger('updated_by')->nullable();

            $table->unsignedTinyInteger('deleted')->default(0)->comment('1=deleted');
            $table->timestamp('deleted_at')->nullable();
            $table->unsignedInteger('deleted_by')->nullable();
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
