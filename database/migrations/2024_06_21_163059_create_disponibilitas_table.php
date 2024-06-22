<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDisponibilitasTable extends Migration
{
    public function up()
    {
        Schema::create('disponibilitas', function (Blueprint $table) {
            $table->id();
            $table->foreignId('negozio_id')->constrained('negozi')->onDelete('cascade'); // Specifica esplicitamente la tabella di riferimento
            $table->string('giorno'); // esempio: 'Lunedi', 'Martedi'
            $table->integer('intervallo')->default(30); // Aggiungi la colonna intervallo con valore predefinito di 30 minuti
            $table->time('fascia_oraria_inizio');
            $table->time('fascia_oraria_fine');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('disponibilitas');
    }
}
