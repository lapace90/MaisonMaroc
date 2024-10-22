@extends('adminlte::page')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header custom-header">
                        <h3>Gestion des Menus</h3>
                        <!-- Bouton avec texte visible uniquement sur les grands écrans -->
                        <a href="{{ route('menus.create') }}" class="btn custom-button float-right d-none d-md-block">
                            Ajouter un Menu
                        </a>
                        <!-- Icône + visible uniquement sur petits écrans -->
                        <a href="{{ route('menus.create') }}" class="btn custom-button float-right d-md-none mb-5">
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
                                        <th style="width: 150px;">Prix</th>
                                        <th style="width: 150px;">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($menus as $menu)
                                        <tr>
                                            <td>{{ $menu->name }}</td>
                                            <td>{{ Str::limit($menu->description, 100) }}</td>
                                            <td>
                                                @if ($menu->photo)
                                                    <img src="{{ asset($menu->photo) }}" alt="{{ $menu->name }}" width="130" class="img-thumbnail">
                                                    @else
                                                    <p>Aucune image disponible</p>
                                                @endif
                                            </td>
                                            <td>{{ $menu->price }} €</td>
                                            <td class="text-center">
                                                <a href="{{ route('menus.show', $menu->id) }}"
                                                    class="btn btn-info btn-sm w-100 my-1">Voir</a>
                                                <a href="{{ route('menus.edit', $menu->id) }}"
                                                    class="btn btn-warning btn-sm w-100 my-1">Modifier</a>
                                                <form action="{{ route('menus.destroy', $menu->id) }}" method="POST"
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
                                @foreach ($menus as $menu)
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <span>
                                            <strong>{{ $menu->name }}</strong><br>                                
                                            {{ $menu->price }} €
                                        </span>
                                        <span>
                                            <a href="{{ route('menus.show', $menu->id) }}"
                                                class="btn btn-info btn-sm">Voir</a>
                                            </form>
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
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
@endsection
