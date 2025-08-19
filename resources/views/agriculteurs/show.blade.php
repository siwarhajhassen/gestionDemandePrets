@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Détails de l'Agriculteur</h1>
    <ul class="list-group">
        <li class="list-group-item"><strong>Nom :</strong> {{ $agriculteur->fullName }}</li>
        <li class="list-group-item"><strong>Email :</strong> {{ $agriculteur->email }}</li>
        <li class="list-group-item"><strong>Identifiant National :</strong> {{ $agriculteur->nationalId }}</li>
        <li class="list-group-item"><strong>Adresse :</strong> {{ $agriculteur->farmAddress }}</li>
        <li class="list-group-item"><strong>Type :</strong> {{ $agriculteur->farmType }}</li>
    </ul>
    <a href="{{ route('agriculteurs.index') }}" class="btn btn-secondary mt-3">Retour</a>
</div>
@endsection
