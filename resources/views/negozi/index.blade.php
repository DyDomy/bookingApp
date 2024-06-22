@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="page-title">I tuoi Negozi</h2>
        <a href="{{ route('negozi.create') }}" class="btn btn-primary mb-3">Aggiungi Negozio</a>
        <div class="store-list">
            @foreach($negozi as $negozio)
                <div class="store-item">
                    <span class="store-name">{{ $negozio->nome }}</span>
                    <div class="store-actions">
                        <a href="{{ route('negozi.edit', $negozio->id) }}" class="btn btn-warning">Modifica</a>
                        <form action="{{ route('negozi.destroy', $negozio->id) }}" method="post" style="display:inline;">
                            @csrf
                            @method('delete')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Sei sicuro di voler eliminare questo negozio?')">Elimina</button>
                        </form>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
