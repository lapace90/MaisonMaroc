@extends('adminlte::page')

@section('title', 'Liste des Réservations')

@section('content')

    <h1>Liste des Réservations</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif
    {{-- Bouton pour revenir à la page précédente --}}
    <div class="form-group row pt-3">
        <button onclick="window.history.back();" class="btn btn-secondary mb-3">Retour</button>
        <a href="{{ route('reservations.create') }}" class="btn btn-primary mb-3">Ajouter une Réservation</a>
    </div>

    @if ($reservations->isEmpty())
        <p>Aucune réservation trouvée.</p>
    @else
        <div class="container-fluid">
            <table class="table">
                <thead>
                    <tr>
                        <th>Nom du Client</th>
                        <th>Dates du Sejur</th>
                        <th>Nombre de Personnes</th>
                        <th>Chambre</th>
                        <th>Montant</th>
                        <th>Statut du Paiement</th>
                        <th>Facture Envoyée</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($reservations as $reservation)
                        <tr>
                            <td>{{ $reservation->customer_name }}</td>
                            <td>Du {{\Carbon\Carbon::parse($reservation->check_in_date)->format('d/m/Y')}} au {{\Carbon\Carbon::parse($reservation->check_out_date)->format('d/m/Y')}}</td>
                            <td>{{ $reservation->number_of_adults + $reservation->number_of_children }} </td>
                            <td>{{ $reservation->room_type_id }}</td>
                            <td>{{ $reservation->amount }}</td>
                            <td>{{ $reservation->payment_status }}</td>
                            <td>{{ $reservation->invoice_sent ? 'Oui' : 'Non' }}</td>
                            <td>
                                <a href="{{ route('reservations.show', $reservation->id) }}" class="btn btn-info">Voir</a>
                                <a href="{{ route('reservations.edit', $reservation->id) }}"
                                    class="btn btn-warning">Modifier</a>
                                <form action="{{ route('reservations.destroy', $reservation->id) }}" method="POST"
                                    style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-danger">Supprimer</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endif
@endsection
