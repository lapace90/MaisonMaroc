@extends('adminlte::page')

@section('title', 'Drafts')

@section('content_header')
    <h1>Liste des Brouillons</h1>
@stop

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header custom-header">
                        <h3>Brouillons de Menus</h3>
                        <!-- Bouton avec texte visible uniquement sur les grands écrans -->
                        <a href="{{ route('menus.create') }}" class="btn custom-button float-right d-none d-md-block">
                            Ajouter un Menu
                        </a>
                        <!-- Icône + visible uniquement sur petits écrans -->
                        <a href="{{ route('menus.create') }}" class="btn custom-button float-right d-md-none">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        @if ($draftsMenus->isEmpty())
                            <p>Aucun brouillon de menu trouvé.</p>
                        @else
                            <!-- Table visible uniquement sur les grands écrans -->
                            <div class="d-none d-md-block">
                                <table class="table table-striped table-bordered">
                                    <thead class="custom-thead">
                                        <tr>
                                            <th style="width: 200px;">Nom</th>
                                            <th style="width: 300px;">Description</th>
                                            <th style="width: 135px;">Photo</th>
                                            <th style="width: 150px;">Prix</th>
                                            <th style="width: 150px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($draftsMenus as $draft)
                                            <tr>
                                                <td>{{ $draft->name }}</td>
                                                <td>{{ Str::limit($draft->description, 100) }}</td>
                                                <td>
                                                    @if ($draft->photo)
                                                        <img src="{{ asset($draft->photo) }}" alt="{{ $draft->name }}"
                                                            width="130" class="img-thumbnail">
                                                    @else
                                                        <p>Aucune image disponible</p>
                                                    @endif
                                                </td>
                                                <td>{{ $draft->price }} €</td>
                                                <td class="text-center">
                                                    <a href="{{ route('drafts.show', $draft->id) }}"
                                                        class="btn btn-info btn-sm w-100 my-1">Voir</a>
                                                    <a href="{{ route('drafts.edit', $draft->id) }}"
                                                        class="btn btn-warning btn-sm w-100 my-1">Modifier</a>
                                                    <form action="{{ route('drafts.destroy', $draft->id) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-danger btn-sm w-100 my-1">Supprimer</button>
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
                                    @foreach ($draftsMenus as $draft)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span>
                                                <strong>{{ $draft->name }}</strong><br>
                                                {{ $draft->price }} €
                                            </span>
                                            <span>
                                                <a href="{{ route('drafts.show', $draft->id) }}"
                                                    class="btn btn-info btn-sm">Voir</a>
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>

                <div class="card mt-5">
                    <div class="card-header custom-header">
                        <h3>Brouillons d'Activités</h3>
                        <!-- Bouton avec texte visible uniquement sur les grands écrans -->
                        <a href="{{ route('activities.create') }}" class="btn custom-button float-right d-none d-md-block">
                            Ajouter une Activité
                        </a>
                        <!-- Icône + visible uniquement sur petits écrans -->
                        <a href="{{ route('activities.create') }}" class="btn custom-button float-right d-md-none">
                            <i class="fas fa-plus"></i>
                        </a>
                    </div>
                    <div class="card-body">
                        @if ($draftsActivities->isEmpty())
                            <p>Aucun brouillon d'activité trouvé.</p>
                        @else
                            <!-- Table visible uniquement sur les grands écrans -->
                            <div class="d-none d-md-block">
                                <table class="table table-striped table-bordered">
                                    <thead class="custom-thead">
                                        <tr>
                                            <th style="width: 200px;">Nom</th>
                                            <th style="width: 300px;">Description</th>
                                            <th style="width: 135px;">Image</th>
                                            <th style="width: 100px;">Durée</th>
                                            <th style="width: 150px;">Prix</th>
                                            <th style="width: 150px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($draftsActivities as $draft)
                                            <tr>
                                                <td>{{ $draft->name }}</td>
                                                <td>{{ Str::limit($draft->description, 100) }}</td>
                                                <td>
                                                    @if ($draft->image)
                                                        <img src="{{ asset($draft->image) }}" alt="{{ $draft->name }}"
                                                            width="130" class="img-thumbnail">
                                                    @else
                                                        <p>Aucune image disponible</p>
                                                    @endif
                                                </td>
                                                <td>{{ $draft->formatted_duration }}</td>
                                                <td>{{ $draft->price }} €</td>
                                                <td class="text-center">
                                                    <a href="{{ route('drafts.show', $draft->id) }}"
                                                        class="btn btn-info btn-sm w-100 my-1">Voir</a>
                                                    <a href="{{ route('drafts.edit', $draft->id) }}"
                                                        class="btn btn-warning btn-sm w-100 my-1">Modifier</a>
                                                    <form action="{{ route('drafts.destroy', $draft->id) }}" method="POST"
                                                        class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit"
                                                            class="btn btn-danger btn-sm w-100 my-1">Supprimer</button>
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
                                    @foreach ($draftsActivities as $draft)
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <span>
                                                <strong>{{ $draft->name }}</strong><br>
                                                {{ $draft->price }} €
                                            </span>
                                            <span>
                                                <a href="{{ route('drafts.show', $draft->id) }}"
                                                    class="btn btn-info btn-sm">Voir</a>
                                            </span>
                                        </li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@stop

@section('js')
    <script>
        console.log("Drafts page loaded!");
    </script>
@stop