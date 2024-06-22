@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Crea Negozio</h2>
        <form action="{{ route('negozi.store') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Crea</button>
        </form>
    </div>
@endsection
