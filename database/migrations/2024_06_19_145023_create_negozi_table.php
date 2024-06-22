<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNegoziTable extends Migration
{
    public function up()
    {
        Schema::create('negozi', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->foreign('proprietario_id')->references('id')->on('utenti')->onDelete('cascade');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('negozi');
    }
}
