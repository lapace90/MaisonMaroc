@extends('adminlte::page')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header custom-header">
                        <h3>Liste des brouillons</h3>
                    </div>
                    <div class="card-body">
                        @if($drafts->isEmpty())
                            <p>Aucun brouillon trouvé.</p>
                        @else
                            <!-- Table visible uniquement sur les grands écrans -->
                            <div class="d-none d-md-block">
                                <table class="table table-striped table-bordered">
                                    <thead class="custom-thead">
                                        <tr>
                                            <th style="width: 200px;">Nom</th>
                                            <th style="width: 250px;">Description</th>
                                            <th>Photo</th>
                                            <th style="width: 100px;">Durée</th>
                                            <th style="width: 125px;">Prix</th>
                                            <th style="width: 150px;">Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($drafts as $draft)
                                            <tr>
                                                <td>{{ $draft->name }}</td>
                                                @if ($draft->description)
                                                    <td>{{ Str::limit($draft->description, 50) }}
                                                        <a href="{{ route('drafts.show', $draft->id) }}">Lire plus</a></td>
                                                @else
                                                    <td>Aucune description disponible</td>
                                                @endif
                                                <td>
                                                    @if ($draft->image)
                                                        <img src="{{ asset($draft->image) }}" alt="{{ $draft->name }}"
                                                            width="50" class="img-thumbnail">
                                                    @else
                                                        <p>Aucune image disponible</p>
                                                    @endif
                                                </td>

                                                <td>{{ $draft->duration }}</td>
                                                <td>{{ $draft->price }} €</td>
                                                <td>
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
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endsection
