<?php

namespace App\Http\Controllers;

use App\Models\Negozio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

class NegozioController extends Controller
{
    public function index()
    {
        $negozi = Negozio::where('proprietario_id', Auth::id())->get();
        return view('negozi.index', compact('negozi'));
    }


    public function create()
    {
        return view('negozi.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        Negozio::create([
            'nome' => $request->nome,
            'proprietario_id' => Auth::id(),
        ]);

        return redirect()->route('negozi.index')->with('success', 'Negozio creato con successo!');
    }


    public function edit(Negozio $negozio)
    {
        $userId = auth()->id();
        $proprietarioId = $negozio->proprietario_id;

        if ($proprietarioId != $userId) {
            abort(403, 'Non sei autorizzato');
        }

        return view('negozi.edit', compact('negozio'));
    }



    public function update(Request $request, Negozio $negozio)
    {
        $userId = auth()->id();
        $proprietarioId = $negozio->proprietario_id;

        if ($proprietarioId != $userId) {
            abort(403, 'Non sei autorizzato');
        }

        $request->validate([
            'nome' => 'required|string|max:255',
        ]);

        $negozio->update($request->only('nome'));

        return redirect()->route('negozi.index')->with('success', 'Negozio aggiornato con successo!');
    }

    public function destroy(Negozio $negozio)
    {
        $userId = auth()->id();
        $proprietarioId = $negozio->proprietario_id;

        if ($proprietarioId != $userId) {
            abort(403, 'Non sei autorizzato');
        }

        $negozio->delete();

        return redirect()->route('negozi.index')->with('success', 'Negozio eliminato con successo!');
    }
}
