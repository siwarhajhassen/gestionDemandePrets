@extends('layouts.app')

@section('title', 'Créer un Agriculteur')

@section('content')
<div class="container">
    <h2>Nouvel Agriculteur</h2>

    <form action="{{ route('agriculteurs.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="username">Nom d'utilisateur</label>
            <input type="text" name="username" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="fullName">Nom complet</label>
            <input type="text" name="fullName" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="email">E-mail</label>
            <input type="email" name="email" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="phone">Téléphone</label>
            <input type="text" name="phone" class="form-control">
        </div>

        <div class="mb-3">
            <label for="nationalId">Identifiant National</label>
            <input type="text" name="nationalId" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="farmAddress">Adresse de la ferme</label>
            <input type="text" name="farmAddress" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="farmType">Type de ferme</label>
            <input type="text" name="farmType" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Créer</button>
    </form>
</div>
@endsection
