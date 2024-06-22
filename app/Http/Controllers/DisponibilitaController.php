<?php

namespace App\Http\Controllers;

use App\Models\Disponibilita;
use App\Models\Negozio;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class DisponibilitaController extends Controller
{
    public function index()
    {
        $disponibilitas = Disponibilita::all();
        return view('disponibilita.index', compact('disponibilitas'));
    }

    public function create()
    {
        $negozi = Negozio::all();
        return view('disponibilita.create', compact('negozi'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'negozio_id' => 'required|exists:negozi,id',
            'data_inizio' => 'required|date',
            'data_fine' => 'required|date|after_or_equal:data_inizio',
            'fascia_oraria_inizio' => 'required|date_format:H:i',
            'fascia_oraria_fine' => 'required|date_format:H:i|after:fascia_oraria_inizio',
            'intervallo' => 'required|integer|min:1',
        ]);

        $negozio_id = $request->negozio_id;
        $data_inizio = Carbon::parse($request->data_inizio);
        $data_fine = Carbon::parse($request->data_fine);
        $fascia_oraria_inizio = Carbon::parse($request->fascia_oraria_inizio);
        $fascia_oraria_fine = Carbon::parse($request->fascia_oraria_fine);
        $intervallo = $request->intervallo;

        for ($date = $data_inizio; $date->lte($data_fine); $date->addDay()) {
            for ($time = $fascia_oraria_inizio; $time->lt($fascia_oraria_fine); $time->addMinutes($intervallo)) {
                Disponibilita::create([
                    'negozio_id' => $negozio_id,
                    'data' => $date->format('Y-m-d'),
                    'fascia_oraria_inizio' => $time->format('H:i'),
                    'fascia_oraria_fine' => $time->copy()->addMinutes($intervallo)->format('H:i'),
                ]);
            }
        }

        return redirect()->route('disponibilita.index')->with('success', 'Disponibilità aggiunta con successo!');
    }


    public function edit(Disponibilita $disponibilita)
    {
        $negozi = Negozio::all();
        return view('disponibilita.edit', compact('disponibilita', 'negozi'));
    }

    public function update(Request $request, Disponibilita $disponibilita)
    {
        $request->validate([
            'negozio_id' => 'required|exists:negozi,id',
            'giorno' => 'required|string',
            'fascia_oraria_inizio' => 'required|date_format:H:i',
            'fascia_oraria_fine' => 'required|date_format:H:i|after:fascia_oraria_inizio',
        ]);

        $disponibilita->update($request->all());

        return redirect()->route('disponibilita.index')->with('success', 'Disponibilità aggiornata con successo!');
    }

    public function getGiornoFromDate($date)
    {
        $giornoSettimana = date('l', strtotime($date)); // Ottiene il giorno della settimana (es. Monday)
        // Mappa il giorno della settimana a quello che hai nel database, ad esempio:
        switch ($giornoSettimana) {
            case 'Monday':
                return 'Lunedi';
            case 'Tuesday':
                return 'Martedi';
            case 'Wednesday':
                return 'Mercoledi';
            case 'Thursday':
                return 'Giovedi';
            case 'Friday':
                return 'Venerdi';
            case 'Saturday':
                return 'Sabato';
            case 'Sunday':
                return 'Domenica';
            default:
                return null;
        }
    }

    public function getDisponibilita(Negozio $negozio, Request $request)
    {
        $data = $request->input('data');

        $disponibilita = Disponibilita::where('negozio_id', $negozio->id)
            ->where('data', $data)
            ->whereDoesntHave('prenotazioni') // Assicurarsi che non ci siano prenotazioni per quella disponibilità
            ->get();

        return response()->json($disponibilita);
    }



    public function destroy(Disponibilita $disponibilita)
    {
        $disponibilita->delete();
        return redirect()->route('disponibilita.index')->with('success', 'Disponibilità eliminata con successo!');
    }
}
