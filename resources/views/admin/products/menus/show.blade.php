@extends('adminlte::page')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header custom-header d-flex justify-content-between align-items-center">
                        <h1 class="card-title"><strong>{{ $menu->name }}</strong></h1>
                        <a href="{{ route('menus.edit', $menu->id) }}" class="btn btn-warning ml-auto"><i
                                class="fas fa-edit"></i></a>
                    </div>
                    <div class="card-body d-flex flex-column flex-md-row">
                        <div class="flex-grow-1">
                            <h5 class="card-text py-3"><strong>Prix : </strong> {{ $menu->price }} €</h5>
                            <h5 class="card-text pt-3"><strong>Plats : </strong></h5>
                            <div class="dishes-list">
                                @php
                                    $categoriesOrder = [
                                        'Entrée',
                                        'Soupe',
                                        'Plat',
                                        'Accompagnement',
                                        'Dessert',
                                        'Boisson',
                                    ];
                                    $sortedDishes = $dishes
                                        ->sortBy(function ($dish) use ($categoriesOrder) {
                                            return array_search($dish->category, $categoriesOrder);
                                        })
                                        ->groupBy('category');
                                @endphp
                                @foreach ($sortedDishes as $category => $dishes)
                                    <div class="category">
                                        <h6 class="category-title">{{ $category }}</h6>
                                        <ul class="list-unstyled">
                                            @foreach ($dishes as $dish)
                                                <li>{{ $dish->name }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <div class="ml-3 mt-3 mt-md-0 d-flex justify-content-center justify-content-md-start">
                            <img src="{{ $menu->photo }}" alt="{{ $menu->name }}" class="img-fluid rounded shadow1"
                                style="max-width: 250px;">
                        </div>
                    </div>
                    <div class="card-body">
                        <h5 class="card-text"><strong>Description :</strong></h5>
                        <p class="card-text">{{ $menu->description }}</p>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <a href="{{ route('menus.index') }}" class="btn custom-button"><i class="fas fa-arrow-left"></i>
                            Retour à la liste</a>
                        <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" class="d-inline ml-auto">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" data-toggle="modal" data-target="#confirmDeleteModal"><i class="fas fa-trash-alt"></i></button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Composant de confirmation d'effacement --}}
    <x-confirm-modal modalId="confirmDeleteModal" title="Confirmer la suppression"
        action="{{ route('menus.destroy', $menu->id) }}" method="DELETE" confirmText="Supprimer">
        Êtes-vous sûr de vouloir supprimer cet élément ?
    </x-confirm-modal>
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endsection
