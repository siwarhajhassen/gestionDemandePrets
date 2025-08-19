@extends('layouts.app')

@section('title', 'Liste des Agriculteurs')

@section('content')
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Agriculteurs</h2>
        <a href="{{ route('agriculteurs.create') }}" class="btn btn-primary">Ajouter un agriculteur</a>
    </div>

    @if($agriculteurs->count())
        <table class="table table-bordered table-striped">
            <thead>
                <tr>
                    <th>Nom complet</th>
                    <th>Email</th>
                    <th>Adresse de la ferme</th>
                    <th>Type de ferme</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($agriculteurs as $agriculteur)
                    <tr>
                        <td>{{ $agriculteur->fullName }}</td>
                        <td>{{ $agriculteur->email }}</td>
                        <td>{{ $agriculteur->farmAddress }}</td>
                        <td>{{ $agriculteur->farmType }}</td>
                        <td>
                            <a href="{{ route('agriculteurs.show', $agriculteur->id) }}" class="btn btn-sm btn-outline-success">Voir</a>
                            <a href="{{ route('agriculteurs.edit', $agriculteur->id) }}" class="btn btn-sm btn-outline-primary">Modifier</a>
                            <form action="{{ route('agriculteurs.destroy', $agriculteur->id) }}" method="POST" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-outline-danger" onclick="return confirm('Confirmer la suppression ?')">Supprimer</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>

        {{ $agriculteurs->links() }} {{-- Pagination --}}
    @else
        <p>Aucun agriculteur trouvé.</p>
    @endif
@endsection
