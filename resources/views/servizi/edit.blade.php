@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Modifica Servizio</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('servizi.update', $servizio->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nome" class="form-label">Nome del Servizio</label>
                <input type="text" name="nome" id="nome" class="form-control" value="{{ $servizio->nome }}" required>
            </div>

            <div class="mb-3">
                <label for="prezzo" class="form-label">Prezzo</label>
                <input type="number" step="0.01" name="prezzo" id="prezzo" class="form-control" value="{{ $servizio->prezzo }}" required>
            </div>

            <div class="mb-3">
                <label for="negozio_id" class="form-label">Negozio</label>
                <select name="negozio_id" id="negozio_id" class="form-control" required>
                    @foreach ($negozi as $negozio)
                        <option value="{{ $negozio->id }}" @if($servizio->negozio_id == $negozio->id) selected @endif>{{ $negozio->nome }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Salva Modifiche</button>
            <a href="{{ route('servizi.index') }}" class="btn btn-secondary">Annulla</a>
        </form>
    </div>
@endsection
