@extends('layouts.app')

@section('title', 'Agriculteurs en Attente de Validation')

@section('content')
<div class="container-fluid">
    <div class="row">
        <div class="col-md-12">
            <div class="d-flex justify-content-between align-items-center mb-4">
                <h1>Agriculteurs en Attente de Validation</h1>
                <div>
                    <a href="{{ route('dashboard.admin') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left"></i> Retour au Dashboard
                    </a>
                </div>
            </div>

            @if(session('success'))
                <div class="alert alert-success alert-dismissible fade show" role="alert">
                    <i class="fas fa-check-circle"></i> {{ session('success') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            @if(session('error'))
                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                    <i class="fas fa-exclamation-circle"></i> {{ session('error') }}
                    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                </div>
            @endif

            <div class="card">
                <div class="card-header bg-warning text-white">
                    <h5 class="mb-0">
                        <i class="fas fa-clock"></i> Demandes d'Inscription en Attente
                        <span class="badge bg-light text-dark ms-2">{{ $agriculteurs->total() }}</span>
                    </h5>
                </div>
                <div class="card-body">
                    @if($agriculteurs->count() > 0)
                        <div class="table-responsive">
                            <table class="table table-striped table-hover">
                                <thead class="table-light">
                                    <tr>
                                        <th>#</th>
                                        <th>Nom Complet</th>
                                        <th>Email</th>
                                        <th>Téléphone</th>
                                        <th>Agence</th>
                                        <th>CIN</th>
                                        <th>Type de Ferme</th>
                                        <th>Date Inscription</th>
                                        <th>Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($agriculteurs as $agriculteur)
                                        <tr>
                                            <td>{{ $agriculteur->id }}</td>
                                            <td>
                                                <strong>{{ $agriculteur->user->prenom }} {{ $agriculteur->user->nom }}</strong>
                                            </td>
                                            <td>{{ $agriculteur->user->email }}</td>
                                            <td>{{ $agriculteur->user->num_tel }}</td>
                                            <td>
                                                @if($agriculteur->agence)
                                                    <span class="badge bg-info">{{ $agriculteur->agence->name }}</span>
                                                @else
                                                    <span class="text-muted">Non assigné</span>
                                                @endif
                                            </td>
                                            <td>{{ $agriculteur->CIN }}</td>
                                            <td>
                                                <span class="badge bg-secondary">{{ $agriculteur->farm_type }}</span>
                                            </td>
                                            <td>
                                                {{ $agriculteur->created_at->format('d/m/Y H:i') }}
                                                <br>
                                                <small class="text-muted">{{ $agriculteur->created_at->diffForHumans() }}</small>
                                            </td>
                                            <td>
                                                <div class="btn-group" role="group">
                                                    <!-- Bouton Approuver -->
                                                    <form action="{{ route('admin.agriculteurs.approve', $agriculteur->id) }}" 
                                                          method="POST" class="d-inline">
                                                        @csrf
                                                        <button type="submit" class="btn btn-sm btn-success" 
                                                                title="Approuver ce compte"
                                                                onclick="return confirm('Êtes-vous sûr de vouloir approuver cet agriculteur ?')">
                                                            <i class="fas fa-check"></i> Approuver
                                                        </button>
                                                    </form>

                                                    <!-- Bouton Rejeter avec modal -->
                                                    <button type="button" class="btn btn-sm btn-danger ms-1" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#rejectModal{{ $agriculteur->id }}"
                                                            title="Rejeter ce compte">
                                                        <i class="fas fa-times"></i> Rejeter
                                                    </button>

                                                    <!-- Bouton Voir détails -->
                                                    <button type="button" class="btn btn-sm btn-info ms-1" 
                                                            data-bs-toggle="modal" 
                                                            data-bs-target="#detailsModal{{ $agriculteur->id }}"
                                                            title="Voir les détails">
                                                        <i class="fas fa-eye"></i> Détails
                                                    </button>
                                                </div>

                                                <!-- Modal de rejet -->
                                                <div class="modal fade" id="rejectModal{{ $agriculteur->id }}" tabindex="-1">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-danger text-white">
                                                                <h5 class="modal-title">Rejeter l'Inscription</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <form action="{{ route('admin.agriculteurs.reject', $agriculteur->id) }}" method="POST">
                                                                @csrf
                                                                <div class="modal-body">
                                                                    <p>Vous êtes sur le point de rejeter l'inscription de :</p>
                                                                    <p><strong>{{ $agriculteur->user->prenom }} {{ $agriculteur->user->nom }}</strong></p>
                                                                    
                                                                    <div class="mb-3">
                                                                        <label for="reason{{ $agriculteur->id }}" class="form-label">Raison du rejet :</label>
                                                                        <textarea class="form-control" id="reason{{ $agriculteur->id }}" 
                                                                                  name="reason" rows="3" required 
                                                                                  placeholder="Expliquez la raison du rejet..."></textarea>
                                                                    </div>
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                                                                    <button type="submit" class="btn btn-danger">Confirmer le Rejet</button>
                                                                </div>
                                                            </form>
                                                        </div>
                                                    </div>
                                                </div>

                                                <!-- Modal de détails -->
                                                <div class="modal fade" id="detailsModal{{ $agriculteur->id }}" tabindex="-1">
                                                    <div class="modal-dialog modal-lg">
                                                        <div class="modal-content">
                                                            <div class="modal-header bg-primary text-white">
                                                                <h5 class="modal-title">Détails de l'Agriculteur</h5>
                                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div class="row">
                                                                    <div class="col-md-6">
                                                                        <h6>Informations Personnelles</h6>
                                                                        <p><strong>Nom complet :</strong> {{ $agriculteur->user->prenom }} {{ $agriculteur->user->nom }}</p>
                                                                        <p><strong>Email :</strong> {{ $agriculteur->user->email }}</p>
                                                                        <p><strong>Téléphone :</strong> {{ $agriculteur->user->num_tel }}</p>
                                                                        <p><strong>CIN :</strong> {{ $agriculteur->CIN }}</p>
                                                                    </div>
                                                                    <div class="col-md-6">
                                                                        <h6>Informations Professionnelles</h6>
                                                                        <p><strong>Agence :</strong> {{ $agriculteur->agence->name ?? 'Non assigné' }}</p>
                                                                        <p><strong>Type de ferme :</strong> {{ $agriculteur->farm_type }}</p>
                                                                        <p><strong>Adresse de la ferme :</strong></p>
                                                                        <p class="text-muted">{{ $agriculteur->farm_address }}</p>
                                                                    </div>
                                                                </div>
                                                                <div class="row mt-3">
                                                                    <div class="col-12">
                                                                        <h6>Date d'Inscription</h6>
                                                                        <p>{{ $agriculteur->created_at->format('d/m/Y à H:i') }} ({{ $agriculteur->created_at->diffForHumans() }})</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="modal-footer">
                                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>

                        <!-- Pagination -->
                        <div class="d-flex justify-content-center mt-4">
                            {{ $agriculteurs->links() }}
                        </div>
                    @else
                        <div class="text-center py-5">
                            <i class="fas fa-check-circle fa-4x text-success mb-3"></i>
                            <h4>Aucune demande en attente</h4>
                            <p class="text-muted">Tous les agriculteurs ont été traités.</p>
                            <a href="{{ route('admin.dashboard') }}" class="btn btn-primary">
                                <i class="fas fa-home"></i> Retour au Dashboard
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('styles')
<style>
    .table th {
        font-weight: 600;
        background-color: #f8f9fa;
    }
    .badge {
        font-size: 0.75em;
    }
    .btn-group .btn {
        margin-bottom: 0.25rem;
    }
    @media (max-width: 768px) {
        .btn-group {
            display: flex;
            flex-direction: column;
        }
        .btn-group .btn {
            margin-bottom: 0.25rem;
        }
    }
</style>
@endsection

@section('scripts')
<script>
    // Script pour gérer les modals
    document.addEventListener('DOMContentLoaded', function() {
        // Auto-focus sur le textarea de raison quand le modal s'ouvre
        const rejectModals = document.querySelectorAll('[id^="rejectModal"]');
        rejectModals.forEach(modal => {
            modal.addEventListener('shown.bs.modal', function () {
                const textarea = this.querySelector('textarea');
                if (textarea) {
                    textarea.focus();
                }
            });
        });

        // Confirmation avant approbation
        const approveForms = document.querySelectorAll('form[action*="approve"]');
        approveForms.forEach(form => {
            form.addEventListener('submit', function(e) {
                if (!confirm('Êtes-vous sûr de vouloir approuver cet agriculteur ?')) {
                    e.preventDefault();
                }
            });
        });
    });
</script>
@endsection