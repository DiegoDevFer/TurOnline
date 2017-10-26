<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAcessoPorQrcodeTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('registroqrcodes', function (Blueprint $table){
            $table->increments('id');
            $table->string('navegador')->default('indefinido');
            $table->ipAddress('ipclient')->nullable();
//            $table->dateTime('entrada');
//            $table->dateTime('saida');
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
        Schema::drop('registroqrcodes');
    }
}
