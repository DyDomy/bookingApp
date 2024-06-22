@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="page-title">Disponibilità Negozi</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('disponibilita.create') }}" class="btn btn-primary mb-3">Aggiungi Disponibilità</a>

        <table class="table">
            <thead>
            <tr>
                <th>Negozio</th>
                <th>Giorno</th>
                <th>Fascia Oraria</th>
                <th>Azioni</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($disponibilitas as $disponibilita)
                <tr>
                    <td>{{ $disponibilita->negozio->nome }}</td>
                    <td>{{ $disponibilita->giorno }}</td>
                    <td>{{ $disponibilita->fascia_oraria_inizio }} - {{ $disponibilita->fascia_oraria_fine }}</td>
                    <td>
                        <a href="{{ route('disponibilita.edit', $disponibilita->id) }}" class="btn btn-warning btn-sm">Modifica</a>
                        <form action="{{ route('disponibilita.destroy', $disponibilita->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger btn-sm">Elimina</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
