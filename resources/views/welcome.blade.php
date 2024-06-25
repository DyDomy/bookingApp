@extends('layouts.app')

@section('content')
    <div class="jumbotron">
        @guest
            <h1>Benvenuto in Gestione Prenotazioni</h1>
            <p>Prenota facilmente il tuo appuntamento presso i nostri negozi.</p>
            <hr>
            <p>Sei un nuovo utente? Registrati subito per iniziare!</p>
            <a class="btn btn-primary" href="{{ route('register') }}" role="button">Registrati</a>
            <a class="btn btn-secondary" href="{{ route('login') }}" role="button">Login</a>
        @else
            <h1>Ciao, {{ Auth::user()->nome }}</h1>
            <p>Benvenuto di nuovo! Puoi gestire le tue prenotazioni e i tuoi servizi.</p>
            <hr>
            <a class="btn btn-primary" href="{{ route('prenotazioni.index') }}" role="button">Le mie prenotazioni</a>
        @endguest
    </div>
@endsection
