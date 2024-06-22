@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="page-title">Aggiungi Disponibilità</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('disponibilita.store') }}" method="POST">
            @csrf

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
                <label for="data_inizio">Data Inizio</label>
                <input type="date" name="data_inizio" id="data_inizio" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="data_fine">Data Fine</label>
                <input type="date" name="data_fine" id="data_fine" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="fascia_oraria_inizio">Fascia Oraria Inizio</label>
                <input type="time" name="fascia_oraria_inizio" id="fascia_oraria_inizio" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="fascia_oraria_fine">Fascia Oraria Fine</label>
                <input type="time" name="fascia_oraria_fine" id="fascia_oraria_fine" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="intervallo">Intervallo (minuti)</label>
                <input type="number" name="intervallo" id="intervallo" class="form-control" value="30" required>
            </div>

            <button type="submit" class="btn btn-primary">Aggiungi Disponibilità</button>
            <a href="{{ route('disponibilita.index') }}" class="btn btn-secondary">Annulla</a>
        </form>
    </div>
@endsection
