@extends('adminlte::page')

@section('title', 'Agenda Fusionné')

@section('content')
    <h1>Agenda des Réservations</h1>
    <div id="calendar"></div>
@endsection

@section('js')
    <script src="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.js"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function () {
            var calendarEl = document.getElementById('calendar');
            var calendar = new FullCalendar.Calendar(calendarEl, {
                initialView: 'dayGridMonth',
                events: [
                    // Ajouter ici les événements provenant de Booking et de ton site
                    {
                        title: 'Réservation 1',
                        start: '2024-10-18'
                    },
                    {
                        title: 'Réservation Booking',
                        start: '2024-10-20'
                    }
                ]
            });
            calendar.render();
        });
    </script>
@endsection

@section('css')
    <link href="https://cdn.jsdelivr.net/npm/fullcalendar@5.10.1/main.min.css" rel="stylesheet">
@endsection
