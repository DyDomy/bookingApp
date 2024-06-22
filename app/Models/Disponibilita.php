<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Disponibilita extends Model
{
    use HasFactory;

    protected $fillable = [

        'negozio_id',
        'giorno',
        'data',
        'fascia_oraria_inizio',
        'fascia_oraria_fine',
        'intervallo'

    ];


    public function negozio()
    {
        return $this->belongsTo(Negozio::class);
    }

    public function prenotazioni()
    {
        return $this->hasMany(Prenotazione::class);
    }
}
