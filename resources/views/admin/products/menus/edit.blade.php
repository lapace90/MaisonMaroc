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
                        <h1>Modification du Menu :</h1>
                        <h3>{{ $menu->name }}</h3>
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

                        {{-- Formulaire d'édition du menu --}}
                        <form action="{{ route('menus.update', $menu->id) }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="form-group">
                                <label for="name">Nom :</label>
                                <input type="text" name="name" class="form-control"
                                    value="{{ old('name', $menu->name) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description :</label>
                                <textarea name="description" class="form-control" required>{{ old('description', $menu->description) }}</textarea>
                            </div>
                            <div class="form-group">
                                <label for="price">Prix :</label>
                                <input type="number" step="0.01" name="price" class="form-control"
                                    value="{{ old('price', $menu->price) }}" required>
                            </div>
                            <div class="form-group">
                                <label for="photo">Photo</label>
                                <input type="file" class="form-control-file" id="photo" name="photo">
                                @if ($menu->photo)
                                    <div class="mt-3">
                                        <img id="current-photo" src="{{ asset($menu->photo) }}" alt="{{ $menu->name }}"
                                            class="img-thumbnail" style="max-width: 150px;">
                                    </div>
                                @endif
                            </div>

                            {{-- Toggle Switch for Active/Inactive Status --}}
                            <div class="form-group">
                                <x-switch-toggle id="menu-status" name="status" :checked="$menu->status" label="Disponible" />
                            </div>

                            {{-- Dropdown to select dishes --}}

                            <div class="form-group">
                                <label for="dishes" class="col-form-label">Choisir les plats :</label>
                                <select id="dishes" name="dishes[]" class="form-control" multiple>
                                    @foreach ($dishes as $category => $categoryDishes)
                                        <optgroup label="{{ $category }}">
                                            @foreach ($categoryDishes as $dish)
                                                <option value="{{ $dish->id }}"
                                                    {{ in_array($dish->id, $menu->dishes->pluck('id')->toArray()) ? 'selected' : '' }}>
                                                    {{ $dish->name }}
                                                </option>
                                            @endforeach
                                        </optgroup>
                                    @endforeach
                                </select>
                            </div>

                            {{-- Bouton pour soumettre les changements --}}
                            <div class="form-group row pt-3">
                                <button type="submit" class="btn custom-create-button col-6 mx-auto">Sauvegarder</button>
                            </div>
                        </form>

                        {{-- Bouton pour revenir à la page précédente --}}
                        <div class="form-group row pt-3">
                            <button onclick="window.history.back();" class="btn btn-secondary col-6 mx-auto">Retour</button>
                        </div>

                        {{-- Formulaire pour supprimer l'objet --}}
                        <form action="{{ route('menus.destroy', $menu->id) }}" method="POST" class="mt-3">
                            @csrf
                            @method('DELETE')
                            <div class="form-group row">
                                <button type="submit" class="btn btn-danger col-6 mx-auto"
                                    onclick="return confirm('Êtes-vous sûr de vouloir supprimer ce menu ?');">
                                    Supprimer
                                </button>
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
            photoInput.addEventListener('click', function() {
                if (lastSavedPhotoSrc) {
                    currentPhoto.src = lastSavedPhotoSrc;
                    photoInput.value = ''; // Clear the file input
                }
            });
        });
    </script>
@endsection
