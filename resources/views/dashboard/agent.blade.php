@extends('layouts.app')

@section('title', 'Dashboard Agent BNA')

@section('content')
<div class="row">
    <div class="col-12">
        <h1>Dashboard Agent BNA</h1>
        <p class="text-muted">Bienvenue, {{ auth()->user()->prenom }} {{ auth()->user()->nom }}</p>
        @isset($agence)
            <div class="alert alert-info">
                <i class="fas fa-building"></i> Agence: <strong>{{ $agence->name }}</strong> ({{ $agence->code }})
            </div>
        @endisset
    </div>
</div>

<!-- Statistiques -->
<div class="row mt-4">
    <div class="col-md-3">
        <div class="card bg-primary text-white">
            <div class="card-body">
                <h5 class="card-title">{{ $stats['total_complaints'] }}</h5>
                <p class="card-text">Réclamations totales</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-warning text-white">
            <div class="card-body">
                <h5 class="card-title">{{ $stats['open_complaints'] }}</h5>
                <p class="card-text">Réclamations ouvertes</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-info text-white">
            <div class="card-body">
                <h5 class="card-title">{{ $stats['total_loan_requests'] }}</h5>
                <p class="card-text">Demandes de prêt</p>
            </div>
        </div>
    </div>
    <div class="col-md-3">
        <div class="card bg-success text-white">
            <div class="card-body">
                <h5 class="card-title">{{ $stats['pending_loan_requests'] }}</h5>
                <p class="card-text">En attente</p>
            </div>
        </div>
    </div>
</div>

<div class="row mt-4">
    <!-- Réclamations récentes -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Réclamations récentes</h5>
            </div>
            <div class="card-body">
                @if($recentComplaints->count() > 0)
                    <div class="list-group">
                        @foreach($recentComplaints as $complaint)
                            <a href="{{ route('agent.complaints.show', $complaint->id) }}" 
                               class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">{{ $complaint->subject }}</h6>
                                    <span class="badge bg-{{ $complaint->status == 'open' ? 'warning' : ($complaint->status == 'resolved' ? 'success' : 'info') }}">
                                        {{ $complaint->status }}
                                    </span>
                                </div>
                                <p class="mb-1 text-truncate">{{ Str::limit($complaint->message, 50) }}</p>
                                <small>De: {{ $complaint->agriculteur->user->prenom }} {{ $complaint->agriculteur->user->nom }}</small>
                            </a>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">Aucune réclamation récente.</p>
                @endif
                <div class="mt-3">
                    <a href="{{ route('agent.complaints') }}" class="btn btn-outline-primary btn-sm">
                        Voir toutes les réclamations
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Demandes de prêt récentes -->
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">Demandes de prêt récentes</h5>
            </div>
            <div class="card-body">
                @if($recentLoanRequests->count() > 0)
                    <div class="list-group">
                        @foreach($recentLoanRequests as $request)
                            <a href="{{ route('agent.loan-requests.show', $request->id) }}" 
                               class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Demande #{{ $request->id }}</h6>
                                    <span class="badge bg-{{ $request->status == 'approved' ? 'success' : ($request->status == 'rejected' ? 'danger' : 'warning') }}">
                                        {{ $request->status }}
                                    </span>
                                </div>
                                <p class="mb-1">Montant: {{ number_format($request->amountRequested, 2) }} €</p>
                                <small>De: {{ $request->agriculteur->user->prenom }} {{ $request->agriculteur->user->nom }}</small>
                            </a>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">Aucune demande de prêt récente.</p>
                @endif
                <div class="mt-3">
                    <a href="{{ route('agent.loan-requests') }}" class="btn btn-outline-info btn-sm">
                        Voir toutes les demandes
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection