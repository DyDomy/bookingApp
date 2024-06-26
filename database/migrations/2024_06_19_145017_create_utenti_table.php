<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUtentiTable extends Migration
{
    public function up()
    {
        Schema::create('utenti', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->string('email')->unique();
            $table->string('password');
            $table->boolean('is_proprietario')->default(false);
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('utenti');
    }
}
