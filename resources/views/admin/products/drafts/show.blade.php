@extends('adminlte::page')

@section('title', 'Détails du Brouillon')

@section('content_header')
    <h1>Détails du Brouillon</h1>
@stop

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header custom-header d-flex justify-content-between align-items-center">
                        <h1 class="card-title">{{ $draft->name }}</h1>
                        <a href="{{ route('drafts.edit', $draft->id) }}" class="btn btn-warning ml-auto"><i
                                class="fas fa-edit"></i> Modifier</a>
                    </div>
                    <div class="card-body">
                        <div class="row">
                            <div class="col-md-6">
                                <p><strong>Prix :</strong> {{ $draft->price }} €</p>
                                @if ($draft->type == 'activity')
                                    <p><strong>Durée :</strong> {{ $draft->formatted_duration }}</p>
                                @endif
                                @if ($draft->type == 'menu')
                                    <p><strong>Plats :</strong></p>
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
                                            $sortedDishes = $draft->dishes
                                                ->sortBy(function ($dish) use ($categoriesOrder) {
                                                    return array_search($dish->category, $categoriesOrder);
                                                })
                                                ->groupBy('category');
                                        @endphp
                                        @foreach ($sortedDishes as $category => $categoryDishes)
                                            <div class="category">
                                                <h6 class="category-title">{{ $category }}</h6>
                                                <ul class="list-unstyled">
                                                    @foreach ($categoryDishes as $dish)
                                                        <li>{{ $dish->name }}</li>
                                                    @endforeach
                                                </ul>
                                            </div>
                                        @endforeach
                                    </div>
                                @endif
                            </div>
                            <div class="col-md-6 text-center">
                                @if ($draft->photo || $draft->image)
                                    <p><strong>Image :</strong></p>
                                    <img src="{{ asset($draft->photo ?? $draft->image) }}" alt="{{ $draft->name }}"
                                        class="img-thumbnail" style="max-width: 250px;">
                                @endif
                            </div>
                        </div>
                        <p class="mt-3"><strong>Description :</strong> {{ $draft->description }}</p>
                    </div>
                    <div class="card-footer d-flex justify-content-between align-items-center">
                        <a href="{{ route('drafts.index') }}" class="btn custom-button"><i class="fas fa-arrow-left"></i> Retour à la liste</a>
                        <div class="ml-auto">
                            <form action="{{ route('drafts.destroy', $draft->id) }}" method="POST" class="d-inline">
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- Composant de confirmation d'effacement --}}
    <x-confirm-modal modalId="confirmDeleteModal" title="Confirmer la suppression"
        action="{{ route('drafts.destroy', $draft->id) }}" method="DELETE" confirmText="Supprimer">
        Êtes-vous sûr de vouloir supprimer cet élément ?
    </x-confirm-modal>
@stop

@section('css')
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@stop

@section('js')
    <script>
        console.log("Draft details page loaded!");
    </script>
@stop
