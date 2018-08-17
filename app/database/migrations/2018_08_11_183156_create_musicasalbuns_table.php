<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMusicasalbunsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('musicasalbuns', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('idMusica')->unsigned();
            $table->foreign('idMusica')->references('id')->on('musicas');
            $table->integer('idAlbum')->unsigned();
            $table->foreign('idAlbum')->references('id')->on('albuns');
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
        Schema::dropIfExists('musicasalbuns');
    }
}
