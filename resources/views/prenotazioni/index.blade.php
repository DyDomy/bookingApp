@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="page-title">Le mie Prenotazioni</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('prenotazioni.create') }}" class="btn btn-primary mb-3">Aggiungi Prenotazione</a>

        @if ($prenotazioni->isEmpty())
            <p>Non hai ancora aggiunto alcuna prenotazione.</p>
        @else
            <table class="table">
                <thead>
                <tr>
                    <th>Negozio</th>
                    <th>Data</th>
                    <th>Orario</th>
                    <th>Azioni</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($prenotazioni as $prenotazione)
                    <tr>
                        <td>{{ $prenotazione->negozio->nome }}</td>
                        <td>{{ $prenotazione->data }}</td>
                        <td>{{ $prenotazione->fascia_oraria }}</td>
                        <td>
                            <a href="{{ route('prenotazioni.edit', $prenotazione->id) }}" class="btn btn-warning">Modifica</a>
                            <form action="{{ route('prenotazioni.destroy', $prenotazione->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Sei sicuro di voler eliminare questa prenotazione?')">Elimina</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
