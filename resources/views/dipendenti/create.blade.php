@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>Aggiungi Dipendente</h1>

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

        <form action="{{ route('dipendenti.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="nome" class="form-label">Nome del Dipendente</label>
                <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome') }}" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email del Dipendente</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email') }}" required>
            </div>

            <div class="mb-3">
                <label for="password" class="form-label">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="negozio_id" class="form-label">Negozio</label>
                <select name="negozio_id" id="negozio_id" class="form-control" required>
                    <option value="">Seleziona un negozio</option>
                    @foreach ($negozi as $negozio)
                        <option value="{{ $negozio->id }}" {{ old('negozio_id') == $negozio->id ? 'selected' : '' }}>{{ $negozio->nome }}</option>
                    @endforeach
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Aggiungi Dipendente</button>
            <a href="{{ route('dipendenti.index') }}" class="btn btn-secondary">Annulla</a>
        </form>
    </div>
@endsection
