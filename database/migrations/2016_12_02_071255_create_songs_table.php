<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class CreateSongsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('songs', function(Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->text('content');
            $table->string('url');
            $table->string('duration');
            $table->integer('album_id');
            $table->integer('artist_id');
            $table->integer('downloaded');
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
        Schema::drop('songs');
    }
}
