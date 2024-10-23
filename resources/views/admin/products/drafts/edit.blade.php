@extends('adminlte::page')

@section('title', 'Modifier le Brouillon')

@section('content_header')
    <h1>Modifier le Brouillon</h1>
@stop

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header custom-header">
                        <h3>Modification du Brouillon : {{ $draft->name }}</h3>
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

                        {{-- Formulaire d'édition du brouillon --}}
                        <form action="{{ route('drafts.update', $draft->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">Nom :</label>
                                <input type="text" name="name" class="form-control" value="{{ old('name', $draft->name) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description :</label>
                                <textarea name="description" class="form-control" required>{{ old('description', $draft->description) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="price">Prix :</label>
                                <input type="number" step="0.01" name="price" class="form-control" value="{{ old('price', $draft->price) }}" required>
                            </div>
                            @if ($draft->type == 'activity')
                                <div class="form-group">
                                    <label for="duration">Durée (minutes) :</label>
                                    <input type="number" name="duration" class="form-control" value="{{ old('duration', $draft->duration) }}" required>
                                </div>
                            @endif
                            <div class="form-group">
                                <label for="photo">Photo</label>
                                <input type="file" class="form-control-file" id="photo" name="photo">
                                @if ($draft->photo || $draft->image)
                                    <div class="mt-3">
                                        <label>Image actuelle :</label>
                                        <img id="current-photo" src="{{ asset($draft->photo ?? $draft->image) }}" alt="{{ $draft->name }}" class="img-thumbnail" style="max-width: 150px;">
                                    </div>
                                @endif
                            </div>
                            @if ($draft->type == 'menu')
                                <div class="form-group">
                                    <label for="dishes" class="col-form-label">Choisir les plats :</label>
                                    <select id="dishes" name="dishes[]" class="form-control" multiple>
                                        @foreach ($dishes as $category => $categoryDishes)
                                            <optgroup label="{{ $category }}">
                                                @foreach ($categoryDishes as $dish)
                                                    <option value="{{ $dish->id }}" {{ in_array($dish->id, $draft->dishes->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                        {{ $dish->name }}
                                                    </option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                            @endif
                            <div class="form-group row pt-3">
                                <button type="submit" class="btn custom-create-button col-6 mx-auto">Sauvegarder</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/choices.css') }}" rel="stylesheet">

    <!-- Initialize Choices.js -->
    <script src="{{ asset('js/choices.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const choices = new Choices('#dishes', {
                removeItemButton: true,
                placeholder: true,
                placeholderValue: 'Modifier les plats',
            });

            // Handle file input change event
            const photoInput = document.getElementById('photo');
            const currentPhoto = document.getElementById('current-photo');
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
                            newPhoto.id = 'current-photo';
                            newPhoto.src = e.target.result;
                            newPhoto.className = 'img-thumbnail mt-3';
                            newPhoto.style.maxWidth = '150px';
                            photoInput.insertAdjacentElement('afterend', newPhoto);
                        }
                    };
                    reader.readAsDataURL(file);
                }
            });

            // Handle dismissing the selected photo
            const dismissButton = document.getElementById('dismiss-photo');
            if (dismissButton) {
                dismissButton.addEventListener('click', function() {
                    if (lastSavedPhotoSrc) {
                        currentPhoto.src = lastSavedPhotoSrc;
                        photoInput.value = ''; // Clear the file input
                    }
                });
            }
        });
    </script>
@stop