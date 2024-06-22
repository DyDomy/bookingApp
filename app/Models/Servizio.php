<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Servizio extends Model
{
    use HasFactory;

    protected $table = 'servizi';


    protected $fillable = ['nome', 'prezzo', 'negozio_id'];

    public function negozio()
    {
        return $this->belongsTo(Negozio::class);
    }

    public function prenotazioni()
    {
        return $this->belongsToMany(Prenotazione::class, 'prenotazione_servizi');
    }
}
