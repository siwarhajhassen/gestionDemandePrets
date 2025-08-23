@extends('layouts.app')

@section('title', 'Tableau de bord Agent BNA')

@section('content')
<div class="row">
    <div class="col-12">
        <h1>Tableau de bord Agent BNA</h1>
        <p>Bienvenue, {{ auth()->user()->prenom }} {{ auth()->user()->nom }}</p>
    </div>
</div>

<div class="row mt-4">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h5 class="mb-0">Dernières demandes de prêt</h5>
            </div>
            <div class="card-body">
                @if($loanRequests->count() > 0)
                    <div class="list-group">
                        @foreach($loanRequests as $request)
                            <a href="{{ route('agent.loan-requests.show', $request->id) }}" 
                               class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Demande #{{ $request->id }}</h6>
                                    <span class="badge bg-{{ $request->loan_status == 'approved' ? 'success' : ($request->loan_status == 'rejected' ? 'danger' : 'warning') }}">
                                        {{ $request->loan_status }}
                                    </span>
                                </div>
                                <p class="mb-1">Montant: {{ number_format($request->amount_requested, 2) }} €</p>
                                <p class="mb-1">Agriculteur: {{ $request->agriculteur->user->prenom }} {{ $request->agriculteur->user->nom }}</p>
                                <small>Date: {{ $request->submission_date->format('d/m/Y') }}</small>
                            </a>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">Aucune demande de prêt pour le moment.</p>
                @endif
                <div class="mt-3">
                    <a href="{{ route('agent.loan-requests.index') }}" class="btn btn-outline-primary">
                        Voir toutes les demandes
                    </a>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-6">
        <div class="card">
            <div class="card-header bg-info text-white">
                <h5 class="mb-0">Dernières réclamations</h5>
            </div>
            <div class="card-body">
                @if($complaints->count() > 0)
                    <div class="list-group">
                        @foreach($complaints as $complaint)
                            <a href="{{ route('agent.complaints.show', $complaint->id) }}" 
                               class="list-group-item list-group-item-action">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">{{ $complaint->subject }}</h6>
                                    <span class="badge bg-{{ $complaint->status == 'resolved' ? 'success' : 'warning' }}">
                                        {{ $complaint->status }}
                                    </span>
                                </div>
                                <p class="mb-1 text-truncate">{{ Str::limit($complaint->message, 50) }}</p>
                                <p class="mb-1">De: {{ $complaint->agriculteur->user->prenom }} {{ $complaint->agriculteur->user->nom }}</p>
                                <small>Date: {{ $complaint->created_at->format('d/m/Y') }}</small>
                            </a>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">Aucune réclamation pour le moment.</p>
                @endif
                <div class="mt-3">
                    <a href="{{ route('agent.complaints.index') }}" class="btn btn-outline-info">
                        Voir toutes les réclamations
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection