<?php

namespace App\Http\Controllers;

use App\Models\Servizio;
use App\Models\Negozio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ServizioController extends Controller
{
    public function index()
    {
        $servizi = Servizio::whereHas('negozio', function ($query) {
            $query->where('proprietario_id', Auth::id());
        })->get();

        return view('servizi.index', compact('servizi'));
    }

    public function create()
    {
        $negozi = Negozio::where('proprietario_id', Auth::id())->get();
        return view('servizi.create', compact('negozi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
            'prezzo' => 'required|numeric',
            'negozio_id' => 'required|exists:negozi,id',
        ]);

        Servizio::create($request->all());

        return redirect()->route('servizi.index')->with('success', 'Servizio creato con successo!');
    }

    public function edit(Servizio $servizio)
    {
        // Verifica se l'utente attualmente autenticato può aggiornare il servizio
        if ($servizio->negozio->proprietario_id != Auth::id()) {
            abort(403, 'Non sei autorizzato a modificare questo servizio.');
        }

        // Recupera tutti i negozi dell'utente attualmente autenticato
        $negozi = Negozio::where('proprietario_id', Auth::id())->get();

        // Ritorna la vista 'servizi.edit' con i dati del servizio e dei negozi
        return view('servizi.edit', compact('servizio', 'negozi'));
    }

    public function update(Request $request, Servizio $servizio)
    {
        if ($servizio->negozio->proprietario_id != Auth::id()) {
            abort(403, 'Non sei autorizzato a modificare questo servizio.');
        }

        $request->validate([
            'nome' => 'required|string|max:255',
            'prezzo' => 'required|numeric',
            'negozio_id' => 'required|exists:negozi,id',
        ]);

        $servizio->update($request->all());

        return redirect()->route('servizi.index')->with('success', 'Servizio aggiornato con successo!');
    }

    public function destroy(Servizio $servizio)
    {
        if ($servizio->negozio->proprietario_id != Auth::id()) {
            abort(403, 'Non sei autorizzato a modificare questo servizio.');
        }

        $servizio->delete();

        return redirect()->route('servizi.index')->with('success', 'Servizio eliminato con successo!');
    }
}
