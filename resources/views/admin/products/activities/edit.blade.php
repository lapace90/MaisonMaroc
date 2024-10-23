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
                        <h1>Modification de l'activité :</h1>
                        <h3>{{ $activity->name }}</h3>
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

                        {{-- Formulaire d'édition de l'activité --}}
                        <form action="{{ route('activities.update', $activity->id) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">Nom :</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', $activity->name) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description :</label>
                                <textarea name="description" class="form-control" required>{{ old('description', $activity->description) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="price">Prix :</label>
                                <input type="number" step="0.01" name="price" class="form-control"
                                    value="{{ old('price', $activity->price) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="image">Photo</label>
                                <input type="file" class="form-control-file" id="image" name="image">
                                @if ($activity->image)
                                    <div class="mt-3">
                                        <img id="current-image" src="{{ asset($activity->image) }}"
                                            alt="{{ $activity->name }}" class="img-thumbnail" style="max-width: 150px;">
                                    </div>
                                @endif
                            </div>
                            <div class="form-group">
                                <label for="duration" class="col-form-label">Définir la durée :</label>
                                <select id="duration" name="duration" class="form-control">
                                    @for ($i = 30; $i <= 300; $i += 30)
                                        <option value="{{ $i }}"
                                            {{ $activity->duration == $i ? 'selected' : '' }}>
                                            {{ $i < 60 ? $i . ' minutes' : floor($i / 60) . ' heure' . ($i >= 90 ? 's' : '') . ($i % 60 != 0 ? ' ' . $i % 60 . ' minutes' : '') }}
                                        </option>
                                    @endfor
                                </select>
                            </div>

                            {{-- Toggle Switch for Active/Inactive Status --}}
                            <div class="form-group">
                                <x-switch-toggle id="activity-status" name="status" :checked="$activity->status" label="Statut" />
                            </div>

                            {{-- Save button --}}
                            <div class="form-group row pt-3">
                                <button type="submit" class="btn custom-create-button col-6 mx-auto">Sauvegarder</button>
                            </div>
                        </form>

                        {{-- Delete button --}}
                        <form action="{{ route('activities.destroy', $activity->id) }}" method="POST" class="pt-3">
                            @csrf
                            @method('DELETE')
                            <div class="form-group row">
                                <button type="submit" class="btn btn-danger col-6 mx-auto">Supprimer</button>
                            </div>
                        </form>

                        {{-- Back button --}}
                        <div class="form-group row pt-3">
                            <a href="{{ url()->previous() }}" class="btn btn-secondary col-6 mx-auto">Retour</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <script>
        // Handle file input change event
        const photoInput = document.getElementById('image');
        const currentPhoto = document.getElementById('current-image');
        let lastSavedPhotoSrc = currentPhoto ? currentPhoto.src : null;

        photoInput.addEventListener('change', function(event) {
            const file = event.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    if (currentPhoto) {
                        currentPhoto.src = e.target.result;
                    } else {
                        const newPhoto = document.createElement('img');
                        newPhoto.id = 'current-image';
                        newPhoto.src = e.target.result;
                        newPhoto.className = 'img-thumbnail mt-3';
                        newPhoto.style.maxWidth = '150px';
                        photoInput.insertAdjacentElement('afterend', newPhoto);
                    }
                };
                reader.readAsDataURL(file);
            }
        });
    </script>
@endsection
