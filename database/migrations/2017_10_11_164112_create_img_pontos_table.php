<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateImgPontosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('imgpontos', function(Blueprint $table){
            $table->increments('id');
            $table->string('path_file_p')->nullable();

            $table->integer('pontotur_id');
            $table->foreign('pontotur_id')->references('id')->on('pontoturs');
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
        Schema::dropIfExists('imgpontos');
    }
}
