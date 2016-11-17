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
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('full_name')->index();
            $table->string('email')->unique();
            $table->string('other_email')->nullable();
            $table->string('password');
            $table->string('phone')->nullabel()->index();
            $table->string('extra_phone')->nullable();
            $table->text('address')->nullable();
            $table->string('avatar')->nullable();
            $table->date('birthday')->nullable();
            $table->string('professional')->nullable();
            $table->unsignedTinyInteger('type')->nullable();
            $table->boolean('gender')->nullable();
            $table->rememberToken();
            $table->softDeletes();
            $table->string('deletion_reason')->nullable();
            $table->timestamps();
        });

        Schema::create('social_networks', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->enum('provider', ['facebook', 'google']);
            $table->string('sid');
            $table->string('token')->nullable();
            $table->string('profile_url')->nullable();
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('social_networks');
        Schema::drop('users');
    }
}
