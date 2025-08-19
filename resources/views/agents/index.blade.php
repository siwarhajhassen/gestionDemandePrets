@extends('layouts.app')

@section('title', 'Agents BNA')

@section('content')
    <h2>Liste des Agents BNA</h2>
    <a href="{{ route('agents.create') }}" class="btn btn-success mb-3">Ajouter un agent</a>

    @if($agents->count())
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>Nom complet</th>
                    <th>Email</th>
                    <th>Identifiant Employé</th>
                    <th>Agence</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($agents as $agent)
                    <tr>
                        <td>{{ $agent->fullName }}</td>
                        <td>{{ $agent->email }}</td>
                        <td>{{ $agent->employeeId }}</td>
                        <td>{{ $agent->branch }}</td>
                        <td>
                            <a href="{{ route('agents.show', $agent->id) }}" class="btn btn-sm btn-outline-success">Voir</a>
                            <a href="{{ route('agents.edit', $agent->id) }}" class="btn btn-sm btn-outline-primary">Modifier</a>
                            <form action="{{ route('agents.destroy', $agent->id) }}" method="POST" style="display:inline-block;">
                                @csrf @method('DELETE')
                                <button class="btn btn-sm btn-outline-danger" onclick="return confirm('Supprimer cet agent ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Aucun agent trouvé.</p>
    @endif
@endsection
