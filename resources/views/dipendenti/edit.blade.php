@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="page-title">Modifica Dipendente</h1>

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

        <form action="{{ route('dipendenti.update', $dipendente->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" class="form-control" value="{{ old('nome', $dipendente->nome) }}" required>
            </div>

            <div class="form-group">
                <label for="cognome">Cognome</label>
                <input type="text" name="cognome" id="cognome" class="form-control" value="{{ old('cognome', $dipendente->cognome) }}" required>
            </div>

            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" value="{{ old('email', $dipendente->email) }}" required>
            </div>

            <div class="form-group">
                <label for="telefono">Telefono</label>
                <input type="text" name="telefono" id="telefono" class="form-control" value="{{ old('telefono', $dipendente->telefono) }}" required>
            </div>

            <button type="submit" class="btn btn-primary">Salva Modifiche</button>
            <a href="{{ route('dipendenti.index') }}" class="btn btn-secondary">Annulla</a>
        </form>
    </div>
@endsection
