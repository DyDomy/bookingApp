<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateForeignKeyOnPrenotazioneServizi extends Migration
{
    public function up()
    {
        Schema::table('prenotazione_servizi', function (Blueprint $table) {
            // Rimuovi la vecchia chiave esterna
            $table->dropForeign(['prenotazione_id']);

            // Aggiungi la nuova chiave esterna con ON DELETE CASCADE
            $table->foreign('prenotazione_id')
                ->references('id')->on('prenotazioni')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('prenotazione_servizi', function (Blueprint $table) {
            // Rimuovi la chiave esterna con ON DELETE CASCADE
            $table->dropForeign(['prenotazione_id']);

            // Ripristina la vecchia chiave esterna senza ON DELETE CASCADE
            $table->foreign('prenotazione_id')
                ->references('id')->on('prenotazioni');
        });
    }
}
