@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Liste des Actions (Action Logs)</h1>

    @if(session('success'))
        <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <a href="{{ route('actionlogs.create') }}" class="btn btn-primary mb-3">Ajouter une nouvelle action</a>

    @if($actionlogs->isEmpty())
        <p>Aucune action trouvée.</p>
    @else
    <table class="table table-bordered table-striped">
        <thead>
            <tr>
                <th>ID</th>
                <th>Action</th>
                <th>Détails</th>
                <th>Effectué par</th>
                <th>Date</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @foreach($actionlogs as $log)
            <tr>
                <td>{{ $log->id }}</td>
                <td>{{ $log->action }}</td>
                <td>{{ \Illuminate\Support\Str::limit($log->details, 50) }}</td>
                <td>{{ $log->performedBy?->fullName ?? 'N/A' }}</td>
                <td>{{ $log->timestamp ?? $log->created_at }}</td>
                <td>
                    <a href="{{ route('actionlogs.show', $log->id) }}" class="btn btn-info btn-sm">Voir</a>
                    <a href="{{ route('actionlogs.edit', $log->id) }}" class="btn btn-warning btn-sm">Modifier</a>
                    <form action="{{ route('actionlogs.destroy', $log->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Confirmer la suppression ?');">
                        @csrf
                        @method('DELETE')
                        <button class="btn btn-danger btn-sm" type="submit">Supprimer</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    @endif
</div> <!-- Fermeture du container -->
@endsection
