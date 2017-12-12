<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePontoTurTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pontoturs', function(Blueprint $table){
            $table->increments('id');
            $table->string('name');
            $table->text('description');
            $table->string('img_capa')->nullable();
            $table->string('categoria')->nullable();
            $table->string('conteudo')->nullable();
//          chaves estrangeiras
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pontoturs');
    }
}
