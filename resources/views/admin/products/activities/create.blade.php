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
                    <div class="card-header custom-header text-white">
                        <h3 class="card-title">Ajouter une Activité</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('activities.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nom de l'activité</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="4" required></textarea>
                            </div>
                            <div class="form-group">
                                <label for="price">Prix</label>
                                <input type="number" step="0.01" class="form-control" id="price" name="price" required>
                            </div>
                            <div class="form-group">
                                <label for="duration" class="col-form-label">Définir la durée :</label>
                                <select id="duration" name="duration" class="form-control">
                                    @for ($i = 30; $i <= 300; $i += 30)
                                        <option {{ $activity->duration == $i ? 'selected' : '' }}>
                                            {{ $i < 60 ? $i . ' minutes' : floor($i / 60) . ' heure' . ($i >= 90 ? 's' : '') . ($i % 60 != 0 ? ' ' . $i % 60 . ' minutes' : '') }}
                                        </option>
                                    @endfor
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="photo">Photo</label>
                                <input type="file" class="form-control-file" id="photo" name="photo">
                            </div>
                            <div class="d-flex justify-content-center mt-4">
                                <button type="submit" class="btn btn-warning col-4 mx-auto" name="draft"
                                    value="1">Sauvegarder Brouillon</button>

                                <button type="submit" class="btn custom-create-button col-4 mx-auto">Créer</button>
                            </div>
                        </form>
                    </div>
                </div>
                <a href="{{ route('activities.index') }}" class="btn custom-button"><i class="fas fa-arrow-left"></i>
                    Retour à la liste</a>
            </div>
        </div>
    </div>
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
@endsection
