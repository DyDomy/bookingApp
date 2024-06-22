<?php

namespace App\Http\Middleware;

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckProprietario
{
    public function handle(Request $request, Closure $next)
    {
        // Verifica se l'utente è autenticato e è un proprietario
        if ($request->user() && $request->user()->is_proprietario) {
            return $next($request);
        }

        // Se l'utente non è un proprietario, puoi reindirizzarlo o gestire l'accesso negato
        return redirect('/')->with('error', 'Accesso negato. Devi essere un proprietario per accedere a questa pagina.');
    }
}
