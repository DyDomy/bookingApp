<?php

namespace App\Http\Controllers;

use App\Models\Dipendente;
use App\Models\Negozio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DipendenteController extends Controller
{
    public function index()
    {
        $dipendenti = Dipendente::whereHas('negozio', function ($query) {
            $query->where('proprietario_id', Auth::id());
        })->get();

        return view('dipendenti.index', compact('dipendenti'));
    }

    public function create()
    {
        $negozi = Negozio::where('proprietario_id', Auth::id())->get();
        return view('dipendenti.create', compact('negozi'));
    }


    public function store(Request $request)
    {

        $request->validate([
            'nome' => 'required|string|max:255',
            'negozio_id' => 'required',
        ]);

        Dipendente::create($request->all());

        return redirect()->route('dipendenti.index')->with('success', 'Dipendente creato con successo!');
    }

    public function edit(Dipendente $dipendente)
    {

        if (!auth()->user()->negozi->pluck('id')->contains($dipendente->negozio_id)) {
            abort(403, 'Non sei autorizzato a modificare questo dipendente');
        }


        $negozi = Negozio::where('proprietario_id', Auth::id())->get();
        return view('dipendenti.edit', compact('dipendente', 'negozi'));
    }

    public function update(Request $request, Dipendente $dipendente)
    {
        if (!auth()->user()->negozi->pluck('id')->contains($dipendente->negozio_id)) {
            abort(403, 'Non sei autorizzato a modificare questo dipendente');
        }

        $request->validate([
            'nome' => 'required|string|max:255',
            'negozio_id' => 'required|exists:negozi,id',
        ]);

        $dipendente->update($request->all());

        return redirect()->route('dipendenti.index')->with('success', 'Dipendente aggiornato con successo!');
    }

    public function destroy(Dipendente $dipendente)
    {
        if (!auth()->user()->negozi->pluck('id')->contains($dipendente->negozio_id)) {
            abort(403, 'Non sei autorizzato a modificare questo dipendente');
        }

        $dipendente->delete();

        return redirect()->route('dipendenti.index')->with('success', 'Dipendente eliminato con successo!');
    }
}
