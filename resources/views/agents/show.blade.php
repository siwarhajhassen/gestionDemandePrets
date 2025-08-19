@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Détails Agent BNA</h1>

    <table class="table table-bordered">
        <tr><th>ID</th><td>{{ $agent->id }}</td></tr>
        <tr><th>Employee ID</th><td>{{ $agent->employeeId }}</td></tr>
        <tr><th>Nom complet</th><td>{{ $agent->fullName }}</td></tr>
        <tr><th>Branche</th><td>{{ $agent->branch }}</td></tr>
        <tr><th>Email</th><td>{{ $agent->email }}</td></tr>
        <tr><th>Téléphone</th><td>{{ $agent->phone }}</td></tr>
        <tr><th>Créé le</th><td>{{ $agent->created_at }}</td></tr>
        <tr><th>Mis à jour le</th><td>{{ $agent->updated_at }}</td></tr>
    </table>

    <a href="{{ route('agents.index') }}" class="btn btn-secondary">Retour à la liste</a>
    <a href="{{ route('agents.edit', $agent->id) }}" class="btn btn-warning">Modifier</a>
</div>
@endsection
