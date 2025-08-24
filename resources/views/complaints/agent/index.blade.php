@extends('layouts.app')

@section('title', 'Gestion des Réclamations - Agent BNA')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <h1>Gestion des Réclamations</h1>
    <div>
        <a href="{{ route('agent.dashboard') }}" class="btn btn-outline-primary">
            <i class="fas fa-arrow-left"></i> Retour au dashboard
        </a>
    </div>
</div>

<!-- Filtres -->
<div class="card mb-4">
    <div class="card-header bg-light">
        <h5 class="mb-0">Filtres</h5>
    </div>
    <div class="card-body">
        <form method="GET" action="{{ route('agent.complaints') }}">
            <div class="row">
                <div class="col-md-4">
                    <label for="status" class="form-label">Statut</label>
                    <select class="form-select" id="status" name="status">
                        <option value="all" {{ $status == 'all' ? 'selected' : '' }}>Tous les statuts</option>
                        <option value="open" {{ $status == 'open' ? 'selected' : '' }}>Ouvert</option>
                        <option value="in_progress" {{ $status == 'in_progress' ? 'selected' : '' }}>En cours</option>
                        <option value="resolved" {{ $status == 'resolved' ? 'selected' : '' }}>Résolu</option>
                    </select>
                </div>
                <div class="col-md-4 align-self-end">
                    <button type="submit" class="btn btn-primary">Filtrer</button>
                    <a href="{{ route('agent.complaints') }}" class="btn btn-secondary">Réinitialiser</a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if($complaints->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Sujet</th>
                            <th>Agriculteur</th>
                            <th>Statut</th>
                            <th>Date</th>
                            <th>Réponses</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($complaints as $complaint)
                            <tr>
                                <td>{{ $complaint->id }}</td>
                                <td>{{ Str::limit($complaint->subject, 50) }}</td>
                                <td>
                                    @if($complaint->agriculteur && $complaint->agriculteur->user)
                                        {{ $complaint->agriculteur->user->prenom }} {{ $complaint->agriculteur->user->nom }}
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>
                                    @php
                                        $statusClass = 'warning';
                                        if ($complaint->status == 'resolved') {
                                            $statusClass = 'success';
                                        } elseif ($complaint->status == 'in_progress') {
                                            $statusClass = 'info';
                                        }
                                    @endphp
                                    <span class="badge bg-{{ $statusClass }}">
                                        {{ $complaint->status }}
                                    </span>
                                </td>
                                <td>{{ $complaint->created_at->format('d/m/Y H:i') }}</td>
                                <td>
                                    <span class="badge bg-secondary">
                                        {{ $complaint->responses->count() }} réponse(s)
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('agent.complaints.show', $complaint->id) }}" 
                                       class="btn btn-sm btn-info" title="Voir les détails">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if($complaint->status != 'resolved')
                                        <a href="{{ route('agent.complaints.show', $complaint->id) }}#respond" 
                                           class="btn btn-sm btn-primary" title="Répondre">
                                            <i class="fas fa-reply"></i>
                                        </a>
                                    @endif
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-4">
                {{ $complaints->links() }}
            </div>
        @else
            <div class="text-center py-4">
                <i class="fas fa-inbox fa-3x text-muted mb-3"></i>
                <p class="text-muted">Aucune réclamation trouvée.</p>
                @if($status != 'all')
                    <a href="{{ route('agent.complaints') }}" class="btn btn-primary">
                        Voir toutes les réclamations
                    </a>
                @endif
            </div>
        @endif
    </div>
</div>
@endsection