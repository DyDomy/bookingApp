<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Negozio extends Model
{
    use HasFactory;

    protected $table = 'negozi';


    protected $fillable = ['nome', 'proprietario_id'];

    public function proprietario()
    {
        return $this->belongsTo(Utente::class, 'proprietario_id');
    }

    public function disponibilitas()
    {
        return $this->hasMany(Disponibilita::class);
    }

    public function dipendenti()
    {
        return $this->hasMany(Dipendente::class);
    }

    public function servizi()
    {
        return $this->hasMany(Servizio::class);
    }

    public function prenotazioni()
    {
        return $this->hasMany(Prenotazione::class);
    }
}
