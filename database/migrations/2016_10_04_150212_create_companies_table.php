<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCompaniesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('companies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->index();
            $table->string('username')->unique();
            $table->string('password');

            $table->string('user_full_name')->nullable();
            $table->string('user_email')->nullable();
            $table->string('user_profession')->nullable();
            $table->string('user_phone')->nullable();

            $table->string('email')->unique();
            $table->string('voen')->nullable();
            $table->string('phone')->nullable();
            $table->text('info')->nullable();
            $table->string('logo')->nullable();
            $table->string('location')->index()->nullable();
            $table->float('rating')->index()->default(0);
            $table->rememberToken();
            $table->softDeletes();
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
        Schema::drop('companies');
    }
}
