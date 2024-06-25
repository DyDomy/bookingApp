<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateForeignKeyOnPrenotazioni extends Migration
{
    public function up()
    {
        Schema::table('prenotazioni', function (Blueprint $table) {
            // Rimuovi la vecchia chiave esterna
            $table->dropForeign(['dipendente_id']);

            // Aggiungi la nuova chiave esterna con ON DELETE CASCADE
            $table->foreign('dipendente_id')
                ->references('id')->on('dipendenti')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('prenotazioni', function (Blueprint $table) {
            // Rimuovi la chiave esterna con ON DELETE CASCADE
            $table->dropForeign(['dipendente_id']);

            // Ripristina la vecchia chiave esterna senza ON DELETE CASCADE
            $table->foreign('dipendente_id')
                ->references('id')->on('dipendenti');
        });
    }
}
