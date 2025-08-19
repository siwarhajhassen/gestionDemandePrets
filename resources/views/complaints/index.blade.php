@extends('layouts.app')

@section('title', 'Réclamations')

@section('content')
    <h2>Réclamations</h2>
    <a href="{{ route('complaints.create') }}" class="btn btn-success mb-3">Nouvelle réclamation</a>

    @if($complaints->count())
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>Auteur</th>
                    <th>Objet</th>
                    <th>Statut</th>
                    <th>Créée le</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($complaints as $complaint)
                    <tr>
                        <td>{{ $complaint->author->fullName ?? '-' }}</td>
                        <td>{{ $complaint->subject }}</td>
                        <td>{{ $complaint->status }}</td>
                        <td>{{ $complaint->created_at }}</td>
                        <td>
                            <a href="{{ route('complaints.show', $complaint->id) }}" class="btn btn-sm btn-outline-success">Voir</a>
                            <a href="{{ route('complaints.edit', $complaint->id) }}" class="btn btn-sm btn-outline-primary">Modifier</a>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @else
        <p>Aucune réclamation trouvée.</p>
    @endif
@endsection


