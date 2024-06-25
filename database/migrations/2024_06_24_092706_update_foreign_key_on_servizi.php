<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateForeignKeyOnServizi extends Migration
{
    public function up()
    {
        Schema::table('servizi', function (Blueprint $table) {
            // Rimuovi la vecchia chiave esterna
            $table->dropForeign(['negozio_id']);

            // Aggiungi la nuova chiave esterna con ON DELETE CASCADE
            $table->foreign('negozio_id')
                ->references('id')->on('negozi')
                ->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('servizi', function (Blueprint $table) {
            // Rimuovi la chiave esterna con ON DELETE CASCADE
            $table->dropForeign(['negozio_id']);

            // Ripristina la vecchia chiave esterna senza ON DELETE CASCADE
            $table->foreign('negozio_id')
                ->references('id')->on('negozi');
        });
    }
}
