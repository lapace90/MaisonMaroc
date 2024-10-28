@extends('adminlte::page')

@section('content')
    @if (session('success'))
        <x-alert type="success" :dismissible="'true'">
            {{ session('success') }}
        </x-alert>
    @endif

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header custom-header">
                        <h1>Modifier la Réservation:</h1>
                        <h4>N° {{ $reservation->id }} du
                            {{ \Carbon\Carbon::parse($reservation->reservation_date)->format('d-m-Y\ (H:i)') }}</h4>
                    </div>
                    <div class="card-body">
                        {{-- Message de validation des erreurs --}}
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        {{-- Formulaire d'édition de la réservation --}}
                        <form action="{{ route('reservations.update', $reservation) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="customer_name">Nom du client</label>
                                <input type="text" name="customer_name" class="form-control"
                                    value="{{ $reservation->customer_name }}" required>
                            </div>

                            <div class="form-group">
                                <label for="check_in_date">Check-In</label>
                                <input type="datetime-local" name="check_in_date" class="form-control"
                                    value="{{ \Carbon\Carbon::parse($reservation->check_in_date)->format('Y-m-d\TH:i') }}"
                                    required>
                            </div>
                            <div class="form-group">
                                <label for="check_out_date">Check-out</label>
                                <input type="datetime-local" name="check_out_date" class="form-control"
                                    value="{{ \Carbon\Carbon::parse($reservation->check_out_date)->format('Y-m-d\TH:i') }}"
                                    required>
                            </div>

                            <div class="form-group">
                                <label for="number_of_adults">Nombre d'Adultes' :</label>
                                <input type="number" name="number_of_adults" class="form-control" required min="1" value="{{ $reservation->number_of_adults}}">
                            </div>
                            <div class="form-group">
                                <label for="number_of_children">Nombre d'Enfants' :</label>
                                <input type="number" name="number_of_children" class="form-control" min="0" value="{{ $reservation->number_of_children}}">
                            </div>
                            <div class="form-group">
                                <select id="reservation_rooms" name="room_type_id" required multiple>
                                    @foreach ($rooms as $room)
                                        <option value="{{ $room->id }}" data-price="{{ $room->price }}" {{ in_array($room->id, $reservation->rooms->pluck('id')->toArray()) ? 'selected' : ''}}>{{ $room->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="reservation_menu">Menus réservés</label>
                                <select id="reservation_menu" name="reservation_menu[]" class="form-control" multiple>
                                    @foreach ($menus as $menu)
                                        <option value="{{ $menu->id }}" data-price="{{ $menu->price }}"
                                            {{ $reservation->menus && in_array($menu->id, $reservation->menus->pluck('id')->toArray()) ? 'selected' : '' }}>
                                            {{ $menu->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="reservation_activity">Activités réservées</label>
                                <select id="reservation_activity" name="reservation_activity[]" class="form-control" multiple>
                                    @foreach ($activities as $activity)
                                        <option value="{{ $activity->id }}" data-price="{{ $activity->price }}"
                                            {{ $reservation->activities && in_array($activity->id, $reservation->activities->pluck('id')->toArray()) ? 'selected' : '' }}>
                                            {{ $activity->name }}
                                        </option>
                                    @endforeach
                                </select>
                            </div>
                            
                            <div class="form-group">
                                <label for="amount">Montant</label>
                                <input type="number" step="0.01" name="amount" id="amount" class="form-control"
                                    value="{{ $reservation->amount }}" required>
                            </div>

                            <div class="form-group">
                                <label for="payment_status">Statut du paiement</label>
                                <select name="payment_status" class="form-control">
                                    <option value="pending"
                                        {{ $reservation->payment_status == 'pending' ? 'selected' : '' }}>En attente
                                    </option>
                                    <option value="paid" {{ $reservation->payment_status == 'paid' ? 'selected' : '' }}>
                                        Payé</option>
                                    <option value="failed"
                                        {{ $reservation->payment_status == 'failed' ? 'selected' : '' }}>Échoué</option>
                                </select>
                            </div>

                            <div class="form-group">
                                <label for="invoice_sent">Facture</label>
                                <x-switch-toggle id="invoice_sent" name="invoice_sent" :checked="$reservation->invoice_sent" label="Envoyée" />
                            </div>

                            <div class="form-group">
                                <label for="notes">Notes</label>
                                <textarea name="notes" class="form-control">{{ $reservation->notes }}</textarea>
                            </div>
                            <div class="form-group row pt-3 d-flex justify-content-around">
                                <button type="submit" class="btn custom-create-button col-5">Mettre à jour</button>
                                <button type="button" class="btn btn-danger col-5" data-toggle="modal"
                                    data-target="#deleteModal">Supprimer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        {{-- Bouton pour revenir à la page précédente --}}
        <div class="form-group row pt-3">
            <button onclick="window.history.back();" class="btn btn-secondary col-6 mx-auto">Retour</button>
        </div>
    </div>
    {{-- Modal de confirmation de suppression --}}
    <x-confirm-modal modalId="deleteModal" title="Confirmer la suppression"
        action="{{ route('reservations.destroy', $reservation->id) }}" method="DELETE" confirmText="Supprimer">
        Êtes-vous sûr de vouloir supprimer cette réservation ?
    </x-confirm-modal>
@stop
@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
    <link rel="stylesheet" href="{{ asset('css/choices.css') }}">
@stop
@section('js')
    <script src="{{ asset('js/choices.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuChoices = new Choices('#reservation_menu', {
                removeItemButton: true,
                placeholder: true,
                placeholderValue: 'Sélectionner les menus',
            });

            const activityChoices = new Choices('#reservation_activity', {
                removeItemButton: true,
                placeholder: true,
                placeholderValue: 'Sélectionner les activités',
            });
            const roomChoices = new Choices('#reservation_rooms', {
                removeItemButton: true,
                placeholder: true,
                placeholderValue: 'Sélectionner les chambres',
            });

            const amountInput = document.getElementById('amount');

            function updateAmount() {
                let totalAmount = 0;

                // Calculate total for selected menus
                const selectedMenus = menuChoices.getValue(true);
                selectedMenus.forEach(menuId => {
                    const menuOption = document.querySelector(`#reservation_menu option[value="${menuId}"]`);
                    totalAmount += parseFloat(menuOption.getAttribute('data-price'));
                });

                // Calculate total for selected activities
                const selectedActivities = activityChoices.getValue(true);
                selectedActivities.forEach(activityId => {
                    const activityOption = document.querySelector(`#reservation_activity option[value="${activityId}"]`);
                    totalAmount += parseFloat(activityOption.getAttribute('data-price'));
                });

                // Calculate total for selected rooms
                const selectedRooms = roomChoices.getValue(true);
                selectedRooms.forEach(roomId => {
                    const roomOption = document.querySelector(`#reservation_rooms option[value="${roomId}`);
                    totalAmount += parseFloat(roomOption.getAttribute('data-price'));
                });

                amountInput.value = totalAmount.toFixed(2);
            }

            // Update amount on change
            menuChoices.passedElement.element.addEventListener('change', updateAmount);
            activityChoices.passedElement.element.addEventListener('change', updateAmount);

            // Initial amount calculation
            updateAmount();
        });
    </script>
@stop
