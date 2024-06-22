<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateServiziTable extends Migration
{
    public function up()
    {
        Schema::create('servizi', function (Blueprint $table) {
            $table->id();
            $table->string('nome');
            $table->decimal('prezzo', 8, 2);
            $table->foreignId('negozio_id')->constrained('negozi');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('servizi');
    }
}
