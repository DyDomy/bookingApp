<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrenotazioneServiziTable extends Migration
{
    public function up()
    {
        Schema::create('prenotazione_servizi', function (Blueprint $table) {
            $table->id();
            $table->foreignId('prenotazione_id')->constrained('prenotazioni');
            $table->foreignId('servizio_id')->constrained('servizi');
        });
    }

    public function down()
    {
        Schema::dropIfExists('prenotazione_servizi');
    }
}
