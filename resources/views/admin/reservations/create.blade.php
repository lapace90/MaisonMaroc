@extends('adminlte::page')

@section('title', 'Ajouter une Réservation')

@section('content_header')
    <h1>Ajouter une Réservation</h1>
@stop

@section('content')
    @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header custom-header">
                        <h3>Nouvelle Réservation</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('reservations.store') }}" method="POST">
                            @csrf
                            <div class="form-group">
                                <label for="customer_name">Nom du Client :</label>
                                <input type="text" name="customer_name" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="check_in_date">Date d'Arrivée :</label>
                                <input type="text" name="check_in_date" id="check_in_date" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="check_out_date">Date de Départ :</label>
                                <input type="text" name="check_out_date" id="check_out_date" class="form-control"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="number_of_adults">Nombre d'Adultes' :</label>
                                <input type="number" name="number_of_adults" class="form-control" required min="1">
                            </div>
                            <div class="form-group">
                                <label for="number_of_children">Nombre d'Enfants' :</label>
                                <input type="number" name="number_of_children" class="form-control" min="0">
                            </div>
                            <div class="form-group col-sm-8">
                                <label for="room_type_id">Type de Chambre :</label>
                                <select id="res_rooms" name="room_type_id" required multiple>
                                    @foreach ($rooms as $room)
                                        <option data-price="{{ $room->price }}">{{ $room->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-8">
                                <label for="res_menus">Menus</label>
                                <select id="res_menus" name="res_menus[]" class="form-control" multiple>
                                    @foreach ($menus as $menu)
                                        <option value="{{ $menu->id }}" data-price="{{ $menu->price }}">
                                            {{ $menu->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group col-sm-8">
                                <label for="res_activity">Activités</label>
                                <select id="res_activities" name="res_activities[]" class="form-control"
                                    multiple>
                                    @foreach ($activities as $activity)
                                        <option value="{{ $activity->id }}" data-price="{{ $activity->price }}">
                                            {{ $activity->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="amount">Montant :</label>
                                <input type="number" step="0.01" name="amount" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="payment_status">Statut du Paiement :</label>
                                <select name="payment_status" class="form-control" required>
                                    <option value="pending">En attente</option>
                                    <option value="paid">Payé</option>
                                    <option value="failed">Échoué</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="invoice_sent">Facture Envoyée :</label>
                                <select name="invoice_sent" class="form-control" required>
                                    <option value="0">Non</option>
                                    <option value="1">Oui</option>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="customer_email">Email de Facturation :</label>
                                <input type="email" name="customer_email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="notes">Notes :</label>
                                <textarea name="notes" class="form-control"></textarea>
                            </div>
                            <button type="submit" class="btn btn-primary">Ajouter</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
<link rel="stylesheet" href="{{ asset('css/choices.css') }}">
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css">
@stop

@section('js')
    <script src="{{ asset('js/choices.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
    <script>
        $(function() {
            $('#check_in_date').daterangepicker({
                singleDatePicker: true,
                locale: {
                    format: 'DD/MM/YYYY'
                }
            });

            $('#check_out_date').daterangepicker({
                singleDatePicker: true,
                locale: {
                    format: 'DD/MM/YYYY'
                }
            });

            const menuChoices = new Choices('#res_menus', {
                removeItemButton: true,
                placeholder: true,
                placeholderValue: 'Sélectionner les menus',
            });

            const activityChoices = new Choices('#res_activities', {
                removeItemButton: true,
                placeholder: true,
                placeholderValue: 'Sélectionner les activités',
            });

            const roomChoices = new Choices('#res_rooms', {
                removeItemButton: true,
                placeholder: true,
                placeholderValue: 'Sélectionner les chambres',
            });

            const amountInput = document.getElementById('amount');
            const numberOfPeopleInput = document.querySelector('input[name="number_of_people"]');
            const checkInDateInput = document.querySelector('input[name="check_in_date"]');
            const checkOutDateInput = document.querySelector('input[name="check_out_date"]');
            const nightPricePerPerson = 100; // Example price per night per person

            function calculateNights(checkInDate, checkOutDate) {
                const checkIn = new Date(checkInDate);
                const checkOut = new Date(checkOutDate);
                const timeDifference = checkOut - checkIn;
                const nights = timeDifference / (1000 * 3600 * 24);
                return nights;
            }

            function updateAmount() {
                let totalAmount = 0;

                // Calculate total for selected menus
                const selectedMenus = menuChoices.getValue(true);
                selectedMenus.forEach(menuId => {
                    const menuOption = document.querySelector(
                    `#reservation_menu option[value="${menuId}"]`);
                    if (menuOption) {
                        totalAmount += parseFloat(menuOption.getAttribute('data-price')) || 0;
                    }
                });

                // Calculate total for selected activities
                const selectedActivities = activityChoices.getValue(true);
                selectedActivities.forEach(activityId => {
                    const activityOption = document.querySelector(
                        `#reservation_activity option[value="${activityId}"]`);
                    if (activityOption) {
                        totalAmount += parseFloat(activityOption.getAttribute('data-price')) || 0;
                    }
                });

                // Calculate total for nights per person/room
                const numberOfPeople = parseInt(numberOfPeopleInput.value, 10) || 0;
                const checkInDate = checkInDateInput.value;
                const checkOutDate = checkOutDateInput.value;
                const nights = calculateNights(checkInDate, checkOutDate);
                totalAmount += nights * numberOfPeople * nightPricePerPerson;

                amountInput.value = totalAmount.toFixed(2);
            }

            // Update amount on change
            menuChoices.passedElement.element.addEventListener('change', updateAmount);
            activityChoices.passedElement.element.addEventListener('change', updateAmount);
            numberOfPeopleInput.addEventListener('input', updateAmount);
            checkInDateInput.addEventListener('change', updateAmount);
            checkOutDateInput.addEventListener('change', updateAmount);

            // Initial amount calculation
            updateAmount();
        });
    </script>
@stop
