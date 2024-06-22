<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RenameAndChangeTypeGiornoToDataInDisponibilitasTable extends Migration
{
    public function up()
    {
        Schema::table('disponibilitas', function (Blueprint $table) {
            $table->date('data')->nullable(); // Step 1: Creare la nuova colonna 'data'
        });

        DB::statement('UPDATE disponibilitas SET data = giorno'); // Step 2: Copiare i dati

        Schema::table('disponibilitas', function (Blueprint $table) {
            $table->dropColumn('giorno'); // Step 3: Eliminare la vecchia colonna 'giorno'
        });

        Schema::table('disponibilitas', function (Blueprint $table) {
            $table->date('data')->nullable(false)->change(); // Step 4: Rendere la colonna 'data' non nullable
        });
    }

    public function down()
    {
        Schema::table('disponibilitas', function (Blueprint $table) {
            $table->string('giorno'); // Step 1: Creare la vecchia colonna 'giorno'
        });

        DB::statement('UPDATE disponibilitas SET giorno = data'); // Step 2: Copiare i dati

        Schema::table('disponibilitas', function (Blueprint $table) {
            $table->dropColumn('data'); // Step 3: Eliminare la colonna 'data'
        });
    }
}

