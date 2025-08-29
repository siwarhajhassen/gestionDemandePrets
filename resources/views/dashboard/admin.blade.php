@extends('layouts.app')

@section('title', 'Dashboard Administrateur')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Dashboard Administrateur</h1>
                <div class="text-end">
                    <p class="text-muted mb-0">Connecté en tant que: <strong>{{ auth()->user()->prenom }} {{ auth()->user()->nom }}</strong></p>
                    <small class="text-muted">Dernière connexion: {{ auth()->user()->last_login_at ? auth()->user()->last_login_at->format('d/m/Y H:i') : 'Première connexion' }}</small>
                </div>
            </div>
        </div>
    </div>

    <!-- Statistiques -->
    <div class="row mb-4">
        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-primary shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                Agriculteurs en Attente</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $pendingAgriculteurs }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-clock fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <div class="mt-2">
                        <a href="{{ route('admin.agriculteurs.pending') }}" class="btn btn-sm btn-primary">
                            <i class="fas fa-list"></i> Voir la liste
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-success shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                Total Agents</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalAgents }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-user-tie fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <div class="mt-2">
                        <a href="{{ route('admin.agents.index') }}" class="btn btn-sm btn-success">
                            <i class="fas fa-cog"></i> Gérer les agents
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-info shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                Total Agences</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalAgences }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-building fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <div class="mt-2">
                        <a href="{{ route('admin.agences.index') }}" class="btn btn-sm btn-info">
                            <i class="fas fa-cog"></i> Gérer les agences
                        </a>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-xl-3 col-md-6 mb-4">
            <div class="card border-left-warning shadow h-100 py-2">
                <div class="card-body">
                    <div class="row no-gutters align-items-center">
                        <div class="col mr-2">
                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                Demandes de Prêt</div>
                            <div class="h5 mb-0 font-weight-bold text-gray-800">{{ $totalLoanRequests }}</div>
                        </div>
                        <div class="col-auto">
                            <i class="fas fa-file-invoice-dollar fa-2x text-gray-300"></i>
                        </div>
                    </div>
                    <div class="mt-2">
                        <a href="#" class="btn btn-sm btn-warning">
                            <i class="fas fa-eye"></i> Voir les demandes
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Actions Rapides -->
    <div class="row">
        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header bg-primary text-white">
                    <h6 class="mb-0"><i class="fas fa-bolt"></i> Actions Rapides</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('admin.agents.create') }}" class="btn btn-outline-primary w-100">
                                <i class="fas fa-plus"></i> Nouvel Agent
                            </a>
                        </div>
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('admin.agences.create') }}" class="btn btn-outline-success w-100">
                                <i class="fas fa-plus"></i> Nouvelle Agence
                            </a>
                        </div>
                        <div class="col-md-6 mb-3">
                            <a href="{{ route('admin.agriculteurs.pending') }}" class="btn btn-outline-warning w-100">
                                <i class="fas fa-check-circle"></i> Valider Inscriptions
                            </a>
                        </div>
                        <div class="col-md-6 mb-3">
                            <a href="#" class="btn btn-outline-info w-100">
                                <i class="fas fa-chart-bar"></i> Statistiques
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="card mb-4">
                <div class="card-header bg-info text-white">
                    <h6 class="mb-0"><i class="fas fa-chart-line"></i> Activité Récente</h6>
                </div>
                <div class="card-body">
                    <div class="text-center py-4">
                        <i class="fas fa-chart-pie fa-3x text-muted mb-3"></i>
                        <p class="text-muted">Module de statistiques à venir</p>
                        <small class="text-muted">Graphiques et analytics en développement</small>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Notifications -->
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header bg-light">
                    <h6 class="mb-0"><i class="fas fa-bell"></i> Notifications Récentes</h6>
                </div>
                <div class="card-body">
                    @if($pendingAgriculteurs > 0)
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle"></i>
                            <strong>{{ $pendingAgriculteurs }} inscription(s)</strong> en attente de validation
                        </div>
                    @else
                        <div class="alert alert-success">
                            <i class="fas fa-check-circle"></i>
                            Aucune inscription en attente de validation
                        </div>
                    @endif
                    
                    <div class="alert alert-info">
                        <i class="fas fa-info-circle"></i>
                        Bienvenue dans le panel d'administration BNA
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection