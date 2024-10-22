@extends('adminlte::page')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header custom-header d-flex justify-content-between align-items-center">
                        <h1 class="card-title">{{ $activity->name }}</h1>
                        <a href="{{ route('activities.edit', $activity->id) }}" class="btn btn-warning ml-auto"><i class="fas fa-edit"></i></a>
                    </div>
                    <div class="card-body">
                        <p class="card-text">{{ $activity->description }}</p>
                        <p class="card-text"><strong>Prix:</strong> {{ $activity->price }} €</p>
                        <p class="card-text"><strong>Durée:</strong> {{ $activity->duration }}</p>
                        <img src="{{ $activity->image }}" alt="{{ $activity->name }}" class="img-fluid rounded d-block mx-auto">
                        <div class="mt-5 d-flex justify-content-between">
                            <a href="{{ route('activities.index') }}" class="btn custom-button"><i class="fas fa-arrow-left"></i> Retour à la liste</a>
                            <form action="{{ route('activities.destroy', $activity->id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-danger"><i class="fas fa-trash-alt"></i></button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
@endsection