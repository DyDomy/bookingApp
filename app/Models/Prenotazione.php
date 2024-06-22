<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Prenotazione extends Model
{
    use HasFactory;

    protected $table = 'prenotazioni';


    protected $fillable = [
        'utente_id',
        'negozio_id',
        'dipendente_id',
        'data',
        'fascia_oraria',
        'disponibilita_id',
    ];


    public function utente()
    {
        return $this->belongsTo(Utente::class);
    }

    public function negozio()
    {
        return $this->belongsTo(Negozio::class);
    }

    public function dipendente()
    {
        return $this->belongsTo(Dipendente::class);
    }

    public function servizi()
    {
        return $this->belongsToMany(Servizio::class, 'prenotazione_servizi');
    }

    public function disponibilita()
    {
        return $this->belongsTo(Disponibilita::class);
    }
}
