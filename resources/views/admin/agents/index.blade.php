@extends('layouts.app')

@section('title', 'Gestion des Agents')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Gestion des Agents</h1>
                <div>
                    <a href="{{ route('dashboard.admin') }}" class="btn btn-outline-secondary me-2">
                        <i class="fas fa-arrow-left"></i> Dashboard
                    </a>
                    <a href="{{ route('admin.agents.create') }}" class="btn btn-primary">
                        <i class="fas fa-plus"></i> Nouvel Agent
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-header bg-dark text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-user-tie"></i> Liste des Agents
                        <span class="badge bg-light text-dark ms-2">{{ $agents->total() }}</span>
                    </h5>
                </div>
                <div class="card-body">
                    @if($agents->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped">
                                <thead>
                                    <tr>
                                        <th>#</th>
                                        <th>Matricule</th>
                                        <th>Nom Complet</th>
                                        <th>Email</th>
                                        <th>Agence</th>
                                        <th>Date Création</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($agents as $agent)
                                        <tr>
                                            <td>{{ $agent->id }}</td>
                                            <td>
                                                <span class="badge bg-primary">{{ $agent->employee_id }}</span>
                                            </td>
                                            <td>
                                                <strong>{{ $agent->user->prenom }} {{ $agent->user->nom }}</strong>
                                            </td>
                                            <td>{{ $agent->user->email }}</td>
                                            <td>
                                                @if($agent->agence)
                                                    <span class="badge bg-info">{{ $agent->agence->name }}</span>
                                                @else
                                                    <span class="text-muted">Non assigné</span>
                                                @endif
                                            </td>
                                            <td>{{ $agent->created_at->format('d/m/Y') }}</td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <button class="btn btn-sm btn-info" title="Voir détails">
                                                        <i class="fas fa-eye"></i>
                                                    </button>
                                                    <button class="btn btn-sm btn-warning" title="Modifier">
                                                        <i class="fas fa-edit"></i>
                                                    </button>
                                                    <form action="{{ route('admin.agents.destroy', $agent->id) }}" 
                                                          method="POST" class="d-inline">
                                                        @csrf
                                                        @method('DELETE')
                                                        <button type="submit" class="btn btn-sm btn-danger" 
                                                                title="Supprimer"
                                                                onclick="return confirm('Êtes-vous sûr de vouloir supprimer cet agent ?')">
                                                            <i class="fas fa-trash"></i>
                                                        </button>
                                                    </form>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <div class="d-flex justify-content-center mt-4">
                            {{ $agents->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-user-tie fa-4x text-muted mb-3"></i>
                            <h4>Aucun agent enregistré</h4>
                            <p class="text-muted">Commencez par créer votre premier agent.</p>
                            <a href="{{ route('admin.agents.create') }}" class="btn btn-primary">
                                <i class="fas fa-plus"></i> Créer un Agent
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
