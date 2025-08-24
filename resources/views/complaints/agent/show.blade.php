@extends('layouts.app')

@section('title', 'Réclamation #' . $complaint->id . ' - Agent BNA')

@section('content')
<div class="row">
    <div class="col-md-8">
        <!-- Détails de la réclamation -->
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Réclamation #{{ $complaint->id }} - {{ $complaint->subject }}</h3>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Statut:</strong>
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
                    </div>
                    <div class="col-md-6">
                        <strong>Date:</strong>
                        {{ $complaint->created_at->format('d/m/Y H:i') }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Agriculteur:</strong>
                        @if($complaint->agriculteur && $complaint->agriculteur->user)
                            {{ $complaint->agriculteur->user->prenom }} {{ $complaint->agriculteur->user->nom }}
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <strong>Email:</strong>
                        @if($complaint->agriculteur && $complaint->agriculteur->user)
                            {{ $complaint->agriculteur->user->email }}
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </div>
                </div>

                <div class="mb-3">
                    <strong>Message:</strong>
                    <div class="border p-3 mt-2 rounded bg-light">
                        {{ $complaint->message }}
                    </div>
                </div>
            </div>
        </div>

        <!-- Réponses -->
        <div class="card mt-4">
            <div class="card-header bg-info text-white">
                <h4 class="mb-0">Réponses</h4>
            </div>
            <div class="card-body">
                @if($complaint->responses->count() > 0)
                    <div class="list-group">
                        @foreach($complaint->responses as $response)
                            <div class="list-group-item">
                                <div class="d-flex justify-content-between align-items-start">
                                    <div class="flex-grow-1">
                                        <h6 class="mb-1">
                                            @if($response->agentBNA && $response->agentBNA->user)
                                                {{ $response->agentBNA->user->prenom }} {{ $response->agentBNA->user->nom }}
                                            @else
                                                Agent BNA
                                            @endif
                                            <small class="text-muted">- {{ $response->created_at->format('d/m/Y H:i') }}</small>
                                        </h6>
                                        <p class="mb-1">{{ $response->message }}</p>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">Aucune réponse pour le moment.</p>
                @endif
            </div>
        </div>

        <!-- Formulaire de réponse -->
        @if($complaint->status != 'resolved')
            <div class="card mt-4" id="respond">
                <div class="card-header bg-success text-white">
                    <h4 class="mb-0">Répondre à la réclamation</h4>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{ route('agent.complaints.respond', $complaint->id) }}">
                        @csrf
                        <div class="mb-3">
                            <label for="message" class="form-label">Votre réponse</label>
                            <textarea class="form-control @error('message') is-invalid @enderror" 
                                      id="message" name="message" rows="4" required
                                      placeholder="Rédigez votre réponse à l'agriculteur...">{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-success">
                            <i class="fas fa-paper-plane"></i> Envoyer la réponse
                        </button>
                    </form>
                </div>
            </div>
        @endif
    </div>

    <div class="col-md-4">
        <!-- Actions -->
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0">Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('agent.complaints') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left"></i> Retour aux réclamations
                    </a>

                    @if($complaint->status != 'resolved')
                        <form method="POST" action="{{ route('agent.complaints.close', $complaint->id) }}">
                            @csrf
                            <button type="submit" class="btn btn-success" 
                                    onclick="return confirm('Êtes-vous sûr de vouloir marquer cette réclamation comme résolue ?')">
                                <i class="fas fa-check"></i> Marquer comme résolu
                            </button>
                        </form>
                    @endif
                </div>
            </div>
        </div>

        <!-- Informations -->
        <div class="card mt-4">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">Informations</h5>
            </div>
            <div class="card-body">
                <p><strong>Référence:</strong> #{{ $complaint->id }}</p>
                <p><strong>Créée le:</strong> {{ $complaint->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Dernière mise à jour:</strong> {{ $complaint->updated_at->format('d/m/Y H:i') }}</p>
                <p><strong>Nombre de réponses:</strong> {{ $complaint->responses->count() }}</p>
            </div>
        </div>
    </div>
</div>
@endsection