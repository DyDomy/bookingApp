<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrenotazioneServizi extends Model
{
    use HasFactory;

    protected $table = 'prenotazione_servizi';

    protected $fillable = ['prenotazione_id', 'servizio_id'];
}
