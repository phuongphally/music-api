<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('requests', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('artist');
            $table->string('src');
            $table->string('thumb');
            $table->integer('duration');
            $table->text('content');
            $table->string('user_id');
            $table->string('status');
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
        Schema::drop('requests');
    }
}
