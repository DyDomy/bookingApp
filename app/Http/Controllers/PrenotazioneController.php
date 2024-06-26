<?php

namespace App\Http\Controllers;

use App\Models\Disponibilita;
use App\Models\Prenotazione;
use App\Models\Negozio;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PrenotazioneController extends Controller
{
    public function index()
    {
        $prenotazioni = Prenotazione::where('utente_id', Auth::id())->get();
        return view('prenotazioni.index', compact('prenotazioni'));
    }

    public function create()
    {
        $negozi = Negozio::all();
        $disponibilitas = Disponibilita::all();
        return view('prenotazioni.create', compact('negozi', 'disponibilitas'));
    }

    public function store(Request $request)
    {
        $userId = Auth::id(); // Ottieni l'ID dell'utente autenticato

        if (!$userId) {
            return redirect()->route('login')->with('error', 'Devi essere autenticato per effettuare una prenotazione.');
        }

        $request->validate([
            'negozio_id' => 'required|exists:negozi,id',
            'dipendente_id' => 'required|exists:dipendenti,id',
            'servizi_id' => 'required|array',
            'data' => 'required|date',
            'fascia_oraria' => 'required|exists:disponibilitas,id',
        ]);

        $disponibilita = Disponibilita::find($request->fascia_oraria);

        if (!$disponibilita) {
            return redirect()->back()->withErrors(['fascia_oraria' => 'La fascia oraria selezionata non è valida.']);
        }

        $prenotazione = Prenotazione::create([
            'utente_id' => $userId, // Assicurati di includere l'ID dell'utente
            'negozio_id' => $request->negozio_id,
            'dipendente_id' => $request->dipendente_id,
            'data' => $request->data,
            'fascia_oraria' => $disponibilita->fascia_oraria_inizio . ' - ' . $disponibilita->fascia_oraria_fine, // Popola la fascia oraria correttamente come stringa
            'disponibilita_id' => $request->fascia_oraria,
        ]);

        $prenotazione->servizi()->attach($request->servizi_id);

        return redirect()->route('prenotazioni.index')->with('success', 'Prenotazione aggiunta con successo!');
    }




    public function show(Prenotazione $prenotazione)
    {
        if (auth()->user()->cannot('view', $prenotazione)) {
            abort(403, 'Non sei autorizzato a visualizzare questa prenotazione');
        }

        return view('prenotazioni.show', compact('prenotazione'));
    }

    public function destroy(Prenotazione $prenotazione)
    {
        if (auth()->user()->cannot('view', $prenotazione)) {
            abort(403, 'Non sei autorizzato a visualizzare questa prenotazione');
        }

        $prenotazione->delete();

        return redirect()->route('prenotazioni.index')->with('success', 'Prenotazione eliminata con successo!');
    }

    public function getDipendenti(Negozio $negozio)
    {
        return response()->json($negozio->dipendenti);
    }


    public function getServizi(Negozio $negozio)
    {
        return response()->json($negozio->servizi);
    }


}
