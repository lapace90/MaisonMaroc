@extends('adminlte::page')

@section('title', 'Détails de l\'Activité')

@section('content_header')
    <h1>Détails de l'Activité</h1>
@stop

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header custom-header d-flex justify-content-between align-items-center">
                        <h1 class="card-title">{{ $activity->name }}</h1>
                        <a href="{{ route('activities.edit', $activity->id) }}" class="btn btn-warning ml-auto"><i class="fas fa-edit"></i></a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p class="card-text"><strong>Prix:</strong> {{ number_format($draft->price, 2) }} €</p>
                                <p class="card-text"><strong>Durée:</strong> {{ $activity->duration }}</p>
                            </div>
                            <div class="col-md-6 text-center">
                                @if ($activity->image)
                                    <img src="{{ asset($activity->image) }}" alt="{{ $activity->name }}" class="img-fluid rounded d-block mx-auto" style="max-width: 250px;">
                                @endif
                            </div>
                        </div>
                        <p class="card-text mt-3"><strong>Description :</strong>{{ $activity->description }}</p>
                        <div class="mt-5 d-flex justify-content-between">
                            <a href="{{ route('activities.index') }}" class="btn custom-button"><i class="fas fa-arrow-left"></i> Retour à la liste</a>
                            <form action="{{ route('activities.destroy', $activity->id) }}" method="POST" class="d-inline">
                                <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Composant de confirmation d'effacement --}}
    <x-confirm-modal modalId="confirmDeleteModal" title="Confirmer la suppression" action="{{ route('activities.destroy', $activity->id) }}" method="DELETE" confirmText="Supprimer">
        Êtes-vous sûr de vouloir supprimer cet élément ?
    </x-confirm-modal>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@stop

@section('js')
    <script>
        console.log("Activity details page loaded!");
    </script>
@stop