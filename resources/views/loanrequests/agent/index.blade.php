@extends('layouts.app')

@section('title', 'Gestion des Demandes de Prêt - Agent BNA')

@section('content')
<div class="d-flex justify-content-between align-items-center mb-4">
    <div>
        <h1>Gestion des Demandes de Prêt</h1>
        @isset($agence)
            <p class="text-muted">Agence: <strong>{{ $agence->name }}</strong> ({{ $agence->code }})</p>
        @endisset
    </div>
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
        <form method="GET" action="{{ route('agent.loan-requests') }}">
            <div class="row">
                <div class="col-md-4">
                    <label for="status" class="form-label">Statut</label>
                    <select class="form-select" id="status" name="status">
                        <option value="all" {{ $status == 'all' ? 'selected' : '' }}>Tous les statuts</option>
                        <option value="draft" {{ $status == 'draft' ? 'selected' : '' }}>Brouillon</option>
                        <option value="submitted" {{ $status == 'submitted' ? 'selected' : '' }}>Soumis</option>
                        <option value="pending" {{ $status == 'pending' ? 'selected' : '' }}>En attente</option>
                        <option value="under_review" {{ $status == 'under_review' ? 'selected' : '' }}>En revue</option>
                        <option value="approved" {{ $status == 'approved' ? 'selected' : '' }}>Approuvé</option>
                        <option value="rejected" {{ $status == 'rejected' ? 'selected' : '' }}>Rejeté</option>
                    </select>
                </div>
                <div class="col-md-4 align-self-end">
                    <button type="submit" class="btn btn-primary">Filtrer</button>
                    <a href="{{ route('agent.loan-requests') }}" class="btn btn-secondary">Réinitialiser</a>
                </div>
            </div>
        </form>
    </div>
</div>

<div class="card">
    <div class="card-body">
        @if($loanRequests->count() > 0)
            <div class="table-responsive">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Montant</th>
                            <th>Agriculteur</th>
                            <th>Type</th>
                            <th>Statut</th>
                            <th>Date soumission</th>
                            <th>Documents</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($loanRequests as $request)
                            <tr>
                                <td>{{ $request->id }}</td>
                                <td>{{ number_format($request->amountRequested, 2) }} €</td>
                                <td>
                                    @if($request->agriculteur && $request->agriculteur->user)
                                        {{ $request->agriculteur->user->prenom }} {{ $request->agriculteur->user->nom }}
                                    @else
                                        <span class="text-muted">N/A</span>
                                    @endif
                                </td>
                                <td>{{ $request->farm_type }}</td>
                                <td>
                                    @php
                                        $statusClass = 'warning';
                                        if ($request->status == 'approved') {
                                            $statusClass = 'success';
                                        } elseif ($request->status == 'rejected') {
                                            $statusClass = 'danger';
                                        } elseif ($request->status == 'submitted') {
                                            $statusClass = 'info';
                                        } elseif ($request->status == 'under_review') {
                                            $statusClass = 'primary';
                                        }
                                    @endphp
                                    <span class="badge bg-{{ $statusClass }}">
                                        {{ $request->status }}
                                    </span>
                                </td>
                                <td>
                                    @if($request->submissionDate)
                                        {{ \Carbon\Carbon::parse($request->submissionDate)->format('d/m/Y') }}
                                    @else
                                        <span class="text-muted">Non soumis</span>
                                    @endif
                                </td>
                                <td>
                                    <span class="badge bg-secondary">
                                        {{ $request->documents->count() }} document(s)
                                    </span>
                                </td>
                                <td>
                                    <a href="{{ route('agent.loan-requests.show', $request->id) }}" 
                                       class="btn btn-sm btn-info" title="Voir les détails">
                                        <i class="fas fa-eye"></i>
                                    </a>
                                    @if(in_array($request->status, ['submitted', 'under_review', 'pending']))
                                        <a href="{{ route('agent.loan-requests.show', $request->id) }}#review" 
                                           class="btn btn-sm btn-warning" title="Examiner">
                                            <i class="fas fa-search"></i>
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
                {{ $loanRequests->links() }}
            </div>
        @else
            <div class="text-center py-4">
                <i class="fas fa-file-invoice-dollar fa-3x text-muted mb-3"></i>
                <p class="text-muted">Aucune demande de prêt trouvée.</p>
                @if($status != 'all')
                    <a href="{{ route('agent.loan-requests') }}" class="btn btn-primary">
                        Voir toutes les demandes
                    </a>
                @endif
            </div>
        @endif
    </div>
</div>
@endsection