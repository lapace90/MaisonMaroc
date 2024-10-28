@extends('adminlte::page')

@section('title', 'Agenda des Réservations')

@section('content')
    <h1>Agenda des Réservations</h1>
    <a href="{{ route('reservations.create') }}" class="btn btn-primary mb-3">Ajouter une Réservation</a>
    <a href="{{ route('reservations.list') }}" class="btn btn-warning mb-3">Voir la liste des résérvations</a>
    <div id="calendar" class="mb-4"></div>
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
                            start: '{{ $reservation->check_in_date }}',
                            end: '{{ $reservation->check_out_date }}',
                            description: 'Nombre de personnes: {{ $reservation->number_of_adults + $reservation->number_of_children }} \n Chambre: {{ $reservation->room_type_id }}',    
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