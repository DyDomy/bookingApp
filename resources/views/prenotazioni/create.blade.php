@extends('layouts.app')

@section('content')
    <div class="container">
        <h1 class="page-title">Aggiungi Prenotazione</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('prenotazioni.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="negozio_id">Negozio</label>
                <select name="negozio_id" id="negozio_id" class="form-control" required>
                    <option value="">Seleziona un negozio</option>
                    @foreach ($negozi as $negozio)
                        <option value="{{ $negozio->id }}">{{ $negozio->nome }}</option>
                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="dipendente_id">Dipendente</label>
                <select name="dipendente_id" id="dipendente_id" class="form-control" required>
                    <option value="">Seleziona un dipendente</option>
                </select>
            </div>

            <div class="form-group">
                <label for="servizi_id">Servizio</label>
                <select name="servizi_id[]" id="servizi_id" class="form-control" multiple required>
                    <option value="">Seleziona un servizio</option>
                </select>
            </div>

            <div class="form-group">
                <label for="data">Data</label>
                <input type="date" name="data" id="data" class="form-control" required>
            </div>

            <div class="form-group">
                <label for="fascia_oraria">Orario</label>
                <select name="fascia_oraria" id="fascia_oraria" class="form-control" required>
                    <option value="">Seleziona una fascia oraria</option>
                </select>
            </div>

            <button type="submit" class="btn btn-primary">Aggiungi Prenotazione</button>
            <a href="{{ route('prenotazioni.index') }}" class="btn btn-secondary">Annulla</a>
        </form>
    </div>

    <script>
        document.getElementById('negozio_id').addEventListener('change', function() {
            var negozioId = this.value;
            var dataInput = document.getElementById('data');
            var fasciaOrariaSelect = document.getElementById('fascia_oraria');

            if (negozioId) {
                fetch(`/negozi/${negozioId}/dipendenti`)
                    .then(response => response.json())
                    .then(data => {
                        var dipendenteSelect = document.getElementById('dipendente_id');
                        dipendenteSelect.innerHTML = '<option value="">Seleziona un dipendente</option>';
                        data.forEach(function(dipendente) {
                            dipendenteSelect.innerHTML += `<option value="${dipendente.id}">${dipendente.nome}</option>`;
                        });
                    });

                fetch(`/negozi/${negozioId}/servizi`)
                    .then(response => response.json())
                    .then(data => {
                        var servizioSelect = document.getElementById('servizi_id');
                        servizioSelect.innerHTML = '<option value="">Seleziona un servizio</option>';
                        data.forEach(function(servizio) {
                            servizioSelect.innerHTML += `<option value="${servizio.id}">${servizio.nome}</option>`;
                        });
                    });

                dataInput.addEventListener('change', function() {
                    var data = this.value;
                    fetch(`/negozi/${negozioId}/disponibilita?data=${data}`)
                        .then(response => response.json())
                        .then(data => {
                            fasciaOrariaSelect.innerHTML = '<option value="">Seleziona una fascia oraria</option>';
                            data.forEach(function(disponibilita) {
                                fasciaOrariaSelect.innerHTML += `<option value="${disponibilita.id}">${disponibilita.fascia_oraria_inizio} - ${disponibilita.fascia_oraria_fine}</option>`;
                            });
                        });
                });
            } else {
                document.getElementById('dipendente_id').innerHTML = '<option value="">Seleziona un dipendente</option>';
                document.getElementById('servizi_id').innerHTML = '<option value="">Seleziona un servizio</option>';
                fasciaOrariaSelect.innerHTML = '<option value="">Seleziona una fascia oraria</option>';
            }
        });

        // Trigger change event on page load to populate dipendente and servizi
        document.getElementById('negozio_id').dispatchEvent(new Event('change'));
    </script>
@endsection
