@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Modifica Negozio</h1>

        @if (session('success'))
            <div class="alert alert-success">
                {{ session('success') }}
            </div>
        @endif

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('negozi.update', $negozio->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-3">
                <label for="nome" class="form-label">Nome del Negozio</label>
                <input type="text" name="nome" id="nome" class="form-control" value="{{ $negozio->nome }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Salva Modifiche</button>
            <a href="{{ route('negozi.index') }}" class="btn btn-secondary">Annulla</a>
        </form>
    </div>
@endsection
