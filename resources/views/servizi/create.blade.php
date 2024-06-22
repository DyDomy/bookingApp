@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="page-title">Aggiungi Servizio</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('servizi.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="nome">Nome del Servizio</label>
                <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome') }}" required>
            </div>

            <div class="form-group">
                <label for="negozio_id">Negozio</label>
                <select name="negozio_id" id="negozio_id" class="form-control" required>
                    <option value="">Seleziona un negozio</option>
                    @foreach ($negozi as $negozio)
                        <option value="{{ $negozio->id }}">{{ $negozio->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="costo">Costo del Servizio</label>
                <input type="number" name="prezzo" id="prezzo" class="form-control" value="{{ old('prezzo') }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Aggiungi Servizio</button>
            <a href="{{ route('servizi.index') }}" class="btn btn-secondary">Annulla</a>
        </form>
    </div>
@endsection
