<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePrenotazioniTable extends Migration
{
    public function up()
    {
        Schema::create('prenotazioni', function (Blueprint $table) {
            $table->id();
            $table->foreignId('utente_id')->constrained('utenti');
            $table->foreignId('negozio_id')->constrained('negozi');
            $table->foreignId('dipendente_id')->constrained('dipendenti');
            $table->date('data');
            $table->time('fascia_oraria');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('prenotazioni');
    }
}
