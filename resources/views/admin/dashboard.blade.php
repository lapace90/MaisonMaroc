@extends('layouts.app')

@section('title', 'Tableau de Bord')

@section('content')
<div class="content-wrapper">
    <section class="content-header">
        <h1>
            Tableau de Bord
        </h1>
    </section>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-3 col-6">
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>150</h3>
                            <p>Nouvelles Réservations</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                        <a href="#" class="small-box-footer">Plus d'infos <i class="fas fa-arrow-circle-right"></i></a>
                    </div>
                </div>
                <!-- Autres éléments -->
            </div>
        </div>
    </section>
</div>
@endsection
