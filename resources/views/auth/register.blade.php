@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Registrazione</h2>
        <form action="{{ route('register') }}" method="post">
            @csrf
            <div class="form-group">
                <label for="nome">Nome</label>
                <input type="text" name="nome" id="nome" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" name="email" id="email" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password">Password</label>
                <input type="password" name="password" id="password" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="password_confirmation">Conferma Password</label>
                <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="is_proprietario">Sei un proprietario?</label>
                <input type="checkbox" name="is_proprietario" id="is_proprietario" value="1">
            </div>
            <button type="submit" class="btn">Registrati</button>
        </form>
    </div>
@endsection
