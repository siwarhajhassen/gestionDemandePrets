@extends('layouts.app')

@section('title', 'Créer un Agent BNA')

@section('content')
<div class="container">
    <h2>Nouvel Agent BNA</h2>

    <form action="{{ route('agents.store') }}" method="POST">
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
            <label for="employeeId">Matricule Agent</label>
            <input type="text" name="employeeId" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="branch">Agence</label>
            <input type="text" name="branch" class="form-control" required>
        </div>

        <button type="submit" class="btn btn-success">Créer</button>
    </form>
</div>
@endsection
