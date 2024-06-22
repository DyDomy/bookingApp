@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="page-title">Modifica Disponibilità</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('disponibilita.update', $disponibilita->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="negozio_id">Negozio</label>
                <select name="negozio_id" id="negozio_id" class="form-control" required>
                    <option value="">Seleziona un negozio</option>
                    @foreach ($negozi as $negozio)
                        <option value="{{ $negozio->id }}" {{ $disponibilita->negozio_id == $negozio->id ? 'selected' : '' }}>
                            {{ $negozio->nome }}
                        </option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="giorno">Giorno</label>
                <select name="giorno" id="giorno" class="form-control" required>
                    <option value="">Seleziona un giorno</option>
                    <option value="Lunedi" {{ $disponibilita->giorno == 'Lunedi' ? 'selected' : '' }}>Lunedì</option>
                    <option value="Martedi" {{ $disponibilita->giorno == 'Martedi' ? 'selected' : '' }}>Martedì</option>
                    <option value="Mercoledi" {{ $disponibilita->giorno == 'Mercoledi' ? 'selected' : '' }}>Mercoledì</option>
                    <option value="Giovedi" {{ $disponibilita->giorno == 'Giovedi' ? 'selected' : '' }}>Giovedì</option>
                    <option value="Venerdi" {{ $disponibilita->giorno == 'Venerdi' ? 'selected' : '' }}>Venerdì</option>
                    <option value="Sabato" {{ $disponibilita->giorno == 'Sabato' ? 'selected' : '' }}>Sabato</option>
                    <option value="Domenica" {{ $disponibilita->giorno == 'Domenica' ? 'selected' : '' }}>Domenica</option>
                </select>
            </div>

            <div class="form-group">
                <label for="fascia_oraria_inizio">Fascia Oraria Inizio</label>
                <input type="time" name="fascia_oraria_inizio" id="fascia_oraria_inizio" class="form-control" value="{{ $disponibilita->fascia_oraria_inizio }}" required>
            </div>

            <div class="form-group">
                <label for="fascia_oraria_fine">Fascia Oraria Fine</label>
                <input type="time" name="fascia_oraria_fine" id="fascia_oraria_fine" class="form-control" value="{{ $disponibilita->fascia_oraria_fine }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Aggiorna Disponibilità</button>
            <a href="{{ route('disponibilita.index') }}" class="btn btn-secondary">Annulla</a>
        </form>
    </div>
@endsection
