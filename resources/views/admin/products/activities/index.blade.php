@extends('adminlte::page')
@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header custom-header">
                        <h3>Liste des activités</h3>
                        <!-- Bouton avec texte visible uniquement sur les grands écrans -->
                        <a href="{{ route('activities.create') }}" class="btn custom-button float-right d-none d-md-block">
                            Ajouter une activité
                        </a>
                        <!-- Icône + visible uniquement sur petits écrans -->
                        <a href="{{ route('activities.create') }}" class="btn custom-button float-right d-md-none">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        <!-- Table visible uniquement sur les grands écrans -->
                        <div class="d-none d-md-block">
                            <table class="table table-striped table-bordered">
                                <thead class="custom-thead">
                                    <tr>
                                        <th style="width: 200px;">Nom</th>
                                        <th style="width: 300px;">Description</th>
                                        <th style="width: 135px;">Photo</th>
                                        <th style="width: 100px;">Durée</th>
                                        <th style="width: 100px;">Prix</th>
                                        <th style="width: 75px">Statut</th>
                                        <th style="width: 100px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($activities as $activity)
                                        <tr>
                                            <td>{{ $activity->name }}</td>
                                            <td>{{ Str::limit($activity->description, 100) }} <a
                                                    href="{{ route('activities.show', $activity->id) }}">Lire plus</a></td>
                                            <td>
                                                @if ($activity->image)
                                                    <!-- Assure-toi d'utiliser le bon attribut pour l'image -->
                                                    <img src="{{ asset($activity->image) }}" alt="{{ $activity->name }}"
                                                        width="130" class="img-thumbnail">
                                                @else
                                                    <p>Aucune image disponible</p>
                                                @endif
                                            </td>
                                            <td>{{ $activity->formatted_duration }}</td>
                                            <td>{{ $activity->price }} €</td>
                                            <td>
                                                @if ($activity->status)
                                                    <span class="badge badge-success" data-toggle="tooltip"
                                                        data-placement="top"
                                                        title="L'activité est visible sur le site">Activé</span>
                                                @else
                                                    <span class="badge badge-danger" data-toggle="tooltip"
                                                        data-placement="top"
                                                        title="L'activité n'est pas visible sur le site">Désactivé</span>
                                                @endif
                                            </td>

                                            <td>

                                                <a href="{{ route('activities.show', $activity->id) }}"
                                                    class="btn btn-info btn-sm w-100 my-1">Voir</a>
                                                <a href="{{ route('activities.edit', $activity->id) }}"
                                                    class="btn btn-warning btn-sm w-100 my-1">Modifier</a>
                                                <form action="{{ route('activities.destroy', $activity->id) }}"
                                                    method="POST" class="d-inline">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit"
                                                        class="btn btn-danger btn-sm w-100 my-1" data-toggle="modal" data-target="#confirmDeleteModal">Supprimer</button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Liste visible uniquement sur les petits écrans -->
                        <div class="d-block d-md-none">
                            <ul class="list-group mt-3">
                                @foreach ($activities as $activity)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>
                                            <strong>{{ $activity->name }}</strong><br>
                                            {{ $activity->price }}
                                        </span>
                                        <span>
                                            <a href="{{ route('activities.show', $activity->id) }}"
                                                class="btn btn-info btn-sm">Voir</a>
                                        </span>
                                    </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Composant de confirmation d'effacement --}}
    <x-confirm-modal modalId="confirmDeleteModal" title="Confirmer la suppression"
        action="{{ route('activities.destroy', $activity->id) }}" method="DELETE" confirmText="Supprimer">
        Êtes-vous sûr de vouloir supprimer cet élément ?
    </x-confirm-modal>
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
@endsection
