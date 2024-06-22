@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>I Miei Dipendenti</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        <a href="{{ route('dipendenti.create') }}" class="btn btn-primary mb-3">Aggiungi Dipendente</a>


        @if ($dipendenti->isEmpty())
            <p>Non hai ancora aggiunto alcun dipendente.</p>
        @else
            <table class="table" style="margin-top: 30px">
                <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Azioni</th>
                </tr>
                </thead>
                <tbody>
                @foreach ($dipendenti as $dipendente)
                    <tr>
                        <td>{{ $dipendente->nome }}</td>
                        <td>{{ $dipendente->email }}</td>
                        <td>
                            <a href="{{ route('dipendenti.edit', $dipendente->id) }}" class="btn btn-warning">Modifica</a>
                            <form action="{{ route('dipendenti.destroy', $dipendente->id) }}" method="POST" style="display:inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger" onclick="return confirm('Sei sicuro di voler eliminare questo dipendente?')">Elimina</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
