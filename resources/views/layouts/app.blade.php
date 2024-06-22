<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Gestione Prenotazioni</title>
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
</head>
<body>
<header class="header">
    <div class="container">
        <a href="{{ url('/') }}" class="header__brand">Gestione Prenotazioni</a>
        <nav class="header__nav">
            <ul class="nav">
                @guest
                    <li class="nav__item">
                        <a class="nav__link" href="{{ route('login') }}">Login</a>
                    </li>
                    <li class="nav__item">
                        <a class="nav__link" href="{{ route('register') }}">Registrazione</a>
                    </li>
                @else
                    <li class="nav__item">
                        <a class="nav__link" href="{{ route('prenotazioni.index') }}">Le mie Prenotazioni</a>
                    </li>
                    @if(Auth::user()->is_proprietario)
                        <li class="nav__item">
                            <a class="nav__link" href="{{ route('negozi.index') }}">I miei Negozi</a>
                        </li>
                        <li class="nav__item">
                            <a class="nav__link" href="{{ route('dipendenti.index') }}">Dipendenti</a>
                        </li>
                        <li class="nav__item">
                            <a class="nav__link" href="{{ route('servizi.index') }}">Servizi</a>
                        </li>
                    @endif
                    <li class="nav__item">
                        <a class="nav__link" href="{{ route('logout') }}"
                           onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                            Logout
                        </a>
                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                            @csrf
                        </form>
                    </li>
                @endguest
            </ul>
        </nav>
    </div>
</header>

<main class="main-content">
    <div class="container">
        @yield('content')
    </div>
</main>

<footer class="footer">
    <div class="container">
        <p>&copy; 2024 Gestione Prenotazioni. Tutti i diritti riservati.</p>
    </div>
</footer>
</body>
</html>
