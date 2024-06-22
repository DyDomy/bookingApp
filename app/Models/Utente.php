<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Utente extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $table = 'utenti';

    protected $fillable = ['nome', 'email', 'password', 'is_proprietario'];

    public function negozi()
    {
        return $this->hasMany(Negozio::class, 'proprietario_id');
    }

    public function prenotazioni()
    {
        return $this->hasMany(Prenotazione::class);
    }
}
