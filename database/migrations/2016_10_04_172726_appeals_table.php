<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AppealsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('appeals', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('tender_id')->nullable();
            $table->unsignedInteger('company_id')->nullable();
            $table->unsignedInteger('user_id')->nullable();
            $table->unsignedTinyInteger('wrote_by')->default(0)->index(); // company(0) or user (1)
            $table->text('content')->nullable();
            $table->string('price')->nullable();
            $table->string('date')->nullable();
            $table->softDeletes();
            $table->timestamps();

            $table->foreign('tender_id')->references('id')->on('tenders')->onDelete('set null');
            $table->foreign('company_id')->references('id')->on('companies')->onDelete('set null');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('appeals');
    }
}
