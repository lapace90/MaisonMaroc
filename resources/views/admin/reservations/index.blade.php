@extends('adminlte::page')

@section('title', 'Agenda des Réservations')

@section('content')
    <h1>Agenda des Réservations</h1>
    <div id="calendar" class="mb-4"></div>
    <h1>Liste des Réservations</h1>

    @if (session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('reservations.create') }}" class="btn btn-primary mb-3">Ajouter une Réservation</a>
    <div class="container-fluid">
        <table class="table">
            <thead>
                <tr>
                    <th>Nom du Client</th>
                    <th>Date de Réservation</th>
                    <th>Nombre de Personnes</th>
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
                        <td>{{ $reservation->reservation_date }}</td>
                        <td>{{ $reservation->number_of_people }}</td>
                        <td>{{ $reservation->amount }}</td>
                        <td>{{ $reservation->payment_status }}</td>
                        <td>{{ $reservation->invoice_sent ? 'Oui' : 'Non' }}</td>
                        <td>
                            <a href="{{ route('reservations.edit', $reservation) }}" class="btn btn-warning">Modifier</a>
                            <form action="{{ route('reservations.destroy', $reservation) }}" method="POST" style="display:inline;">
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
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: [
                    @foreach ($reservations as $reservation)
                        {
                            title: '{{ $reservation->customer_name }}',
                            start: '{{ $reservation->reservation_date }}',
                            description: 'Nombre de personnes: {{ $reservation->number_of_people }}',
                        },
                    @endforeach
                ],
                eventRender: function(info) {
                    var tooltip = new Tooltip(info.el, {
                        title: info.event.extendedProps.description,
                        placement: 'top',
                        trigger: 'hover',
                        container: 'body'
                    });
                },
                firstDay: 1, // Set the week to start on Monday
                height: 'auto', // Adjust the height to fit the content
                aspectRatio: 1.35, // Adjust the aspect ratio for better responsiveness
                headerToolbar: {
                    left: 'prev,next today',
                    center: 'title',
                    right: 'dayGridMonth,timeGridWeek,timeGridDay'
                },
                windowResize: function(view) {
                    if (window.innerWidth < 768) {
                        calendar.changeView('timeGridDay'); // Change to day view on small screens
                    } else {
                        calendar.changeView('dayGridMonth'); // Change to month view on larger screens
                    }
                }
            });
            calendar.render();
        });
    </script>
@endsection

@section('css')
<link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet">
@endsection