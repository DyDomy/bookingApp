@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Lista Servizi</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('servizi.create') }}" class="btn btn-primary mb-3">Aggiungi Servizio</a>

        <table class="table table-bordered">
            <thead>
            <tr>
                <th>Nome</th>
                <th>Prezzo</th>
                <th>Negozio</th>
                <th>Azioni</th>
            </tr>
            </thead>
            <tbody>
            @foreach ($servizi as $servizio)
                <tr>
                    <td>{{ $servizio->nome }}</td>
                    <td>{{ $servizio->prezzo }}</td>
                    <td>{{ $servizio->negozio->nome }}</td>
                    <td>
                        <a href="{{ route('servizi.edit', $servizio->id) }}" class="btn btn-warning">Modifica</a>
                        <form action="{{ route('servizi.destroy', $servizio->id) }}" method="POST" style="display:inline;">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Elimina</button>
                        </form>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
