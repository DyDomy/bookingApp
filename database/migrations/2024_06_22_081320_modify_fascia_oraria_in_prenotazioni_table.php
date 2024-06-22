<?php


use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyFasciaOrariaInPrenotazioniTable extends Migration
{
    public function up()
    {
        Schema::table('prenotazioni', function (Blueprint $table) {
            $table->string('fascia_oraria')->change();
        });
    }

    public function down()
    {
        Schema::table('prenotazioni', function (Blueprint $table) {
            $table->time('fascia_oraria')->change(); // Revert to original type if needed
        });
    }
}
