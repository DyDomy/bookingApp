<?php

use App\Http\Controllers\DisponibilitaController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\NegozioController;
use App\Http\Controllers\DipendenteController;
use App\Http\Controllers\ServizioController;
use App\Http\Controllers\PrenotazioneController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login', [AuthController::class, 'showLoginForm'])->name('login');
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/register', [AuthController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [AuthController::class, 'register']);

Route::middleware(['auth'])->group(function () {

    Route::get('disponibilita', [DisponibilitaController::class, 'index'])->name('disponibilita.index');

    Route::get('/prenotazioni', [PrenotazioneController::class, 'index'])->name('prenotazioni.index');
    Route::get('/prenotazioni/create', [PrenotazioneController::class, 'create'])->name('prenotazioni.create');
    Route::post('/prenotazioni', [PrenotazioneController::class, 'store'])->name('prenotazioni.store');
    Route::get('/prenotazioni/{prenotazione}', [PrenotazioneController::class, 'show'])->name('prenotazioni.show');
    Route::delete('/prenotazioni/{prenotazione}', [PrenotazioneController::class, 'destroy'])->name('prenotazioni.destroy');
    Route::get('negozi/{negozio}/dipendenti', [PrenotazioneController::class, 'getDipendenti'])->name('negozi.dipendenti');
    Route::get('negozi/{negozio}/servizi', [PrenotazioneController::class, 'getServizi'])->name('negozi.servizi');
    Route::get('negozi/{negozio}/disponibilita', [DisponibilitaController::class, 'getDisponibilita']);

    // Rotta per modificare una prenotazione
    Route::get('prenotazioni/{prenotazione}/edit', [PrenotazioneController::class, 'edit'])->name('prenotazioni.edit');
// Rotta per modificare una prenotazione
    Route::get('prenotazioni/{prenotazione}/edit', [PrenotazioneController::class, 'edit'])->name('prenotazioni.edit');
    Route::put('prenotazioni/{prenotazione}', [PrenotazioneController::class, 'update'])->name('prenotazioni.update');
    Route::middleware(['is-proprietario'])->group(function () {

        Route::get('disponibilita/create', [DisponibilitaController::class, 'create'])->name('disponibilita.create');
        Route::post('disponibilita', [DisponibilitaController::class, 'store'])->name('disponibilita.store');
        Route::get('disponibilita/{disponibilita}/edit', [DisponibilitaController::class, 'edit'])->name('disponibilita.edit');
        Route::put('disponibilita/{disponibilita}', [DisponibilitaController::class, 'update'])->name('disponibilita.update');
        Route::delete('disponibilita/{disponibilita}', [DisponibilitaController::class, 'destroy'])->name('disponibilita.destroy');

        Route::get('/negozi', [NegozioController::class, 'index'])->name('negozi.index');
        Route::get('/negozi/create', [NegozioController::class, 'create'])->name('negozi.create');
        Route::post('/negozi', [NegozioController::class, 'store'])->name('negozi.store');
        Route::get('/negozi/{negozio}/edit', [NegozioController::class, 'edit'])->name('negozi.edit');
        Route::put('/negozi/{negozio}', [NegozioController::class, 'update'])->name('negozi.update');
        Route::delete('/negozi/{negozio}', [NegozioController::class, 'destroy'])->name('negozi.destroy');


        Route::get('/dipendenti', [DipendenteController::class, 'index'])->name('dipendenti.index');
        Route::get('/dipendenti/create', [DipendenteController::class, 'create'])->name('dipendenti.create');
        Route::post('/dipendenti', [DipendenteController::class, 'store'])->name('dipendenti.store');
        Route::get('/dipendenti/{dipendente}/edit', [DipendenteController::class, 'edit'])->name('dipendenti.edit');
        Route::put('/dipendenti/{dipendente}', [DipendenteController::class, 'update'])->name('dipendenti.update');
        Route::delete('/dipendenti/{dipendente}', [DipendenteController::class, 'destroy'])->name('dipendenti.destroy');

        Route::get('/servizi', [ServizioController::class, 'index'])->name('servizi.index');
        Route::get('/servizi/create', [ServizioController::class, 'create'])->name('servizi.create');
        Route::post('/servizi', [ServizioController::class, 'store'])->name('servizi.store');
        Route::get('/servizi/{servizio}/edit', [ServizioController::class, 'edit'])->name('servizi.edit');
        Route::put('/servizi/{servizio}', [ServizioController::class, 'update'])->name('servizi.update');
        Route::delete('/servizi/{servizio}', [ServizioController::class, 'destroy'])->name('servizi.destroy');

        Route::resource('negozi', NegozioController::class);
        Route::resource('dipendenti', DipendenteController::class);
        Route::resource('servizi', ServizioController::class);
        Route::resource('disponibilita', DisponibilitaController::class)->except(['show']);

    });
});
