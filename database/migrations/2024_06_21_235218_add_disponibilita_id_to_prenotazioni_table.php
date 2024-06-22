<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddDisponibilitaIdToPrenotazioniTable extends Migration
{
    public function up()
    {
        Schema::table('prenotazioni', function (Blueprint $table) {
            $table->foreignId('disponibilita_id')->constrained('disponibilitas')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::table('prenotazioni', function (Blueprint $table) {
            $table->dropForeign(['disponibilita_id']);
            $table->dropColumn('disponibilita_id');
        });
    }
}

