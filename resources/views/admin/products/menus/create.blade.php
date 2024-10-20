@extends('adminlte::page')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header custom-header">
                        <h3 class="card-title">Ajouter un Menu</h3>
                    </div>
                    <div class="card-body">
                        <form action="{{ route('menus.store') }}" method="POST" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Nom du menu</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            <div class="form-group">
                                <label for="description">Description</label>
                                <textarea class="form-control" id="description" name="description" rows="4"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="price">Prix</label>
                                <input type="number" class="form-control" id="price" name="price" required>
                            </div>
                            <div class="form-group">
                                <label for="photo">Photo</label>
                                <input type="file" class="form-control-file" id="photo" name="photo">
                            </div>
                            <div class="form-group">
                                <label for="dishes" class="col-sm-4 col-form-label">Choisir les plats :</label>
                                <div class="col-sm-8">
                                    <select id="dishes" name="dishes[]" class="form-control" multiple>
                                        @foreach ($dishes as $category => $categoryDishes)
                                            <optgroup label="{{ $category }}">
                                                @foreach ($categoryDishes as $dish)
                                                    <option value="{{ $dish->id }}">{{ $dish->name }}</option>
                                                @endforeach
                                            </optgroup>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="form-group row pt-3">
                                <button type="submit" class="btn custom-create-button col-6 mx-auto">Créer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- CSS -->
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="{{ asset('css/choices.css') }}" rel="stylesheet">

    <!-- Initialize Choices.js -->
    <script src="{{ asset('js/choices.js') }}"></script>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const choices = new Choices('#dishes', {
                removeItemButton: true,
                placeholder: true,
                placeholderValue: 'Sélectionnez des plats',
            });
        });
    </script>
@endsection
