@extends('layouts.app')

@section('title', 'Demande de Prêt #' . $loanRequest->id . ' - Agent BNA')

@section('content')
<div class="row">
    <div class="col-md-8">
        <!-- Détails de la demande -->
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Demande de Prêt #{{ $loanRequest->id }}</h3>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Statut:</strong>
                        @php
                            $statusClass = 'warning';
                            if ($loanRequest->status == 'approved') {
                                $statusClass = 'success';
                            } elseif ($loanRequest->status == 'rejected') {
                                $statusClass = 'danger';
                            } elseif ($loanRequest->status == 'submitted') {
                                $statusClass = 'info';
                            } elseif ($loanRequest->status == 'under_review') {
                                $statusClass = 'primary';
                            }
                        @endphp
                        <span class="badge bg-{{ $statusClass }}">
                            {{ $loanRequest->status }}
                        </span>
                    </div>
                    <div class="col-md-6">
                        <strong>Date de soumission:</strong>
                        @if($loanRequest->submissionDate)
                            {{ \Carbon\Carbon::parse($loanRequest->submissionDate)->format('d/m/Y H:i') }}
                        @else
                            <span class="text-muted">Non soumis</span>
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Agriculteur:</strong>
                        @if($loanRequest->agriculteur && $loanRequest->agriculteur->user)
                            {{ $loanRequest->agriculteur->user->prenom }} {{ $loanRequest->agriculteur->user->nom }}
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <strong>Email:</strong>
                        @if($loanRequest->agriculteur && $loanRequest->agriculteur->user)
                            {{ $loanRequest->agriculteur->user->email }}
                        @else
                            <span class="text-muted">N/A</span>
                        @endif
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Montant demandé:</strong>
                        {{ number_format($loanRequest->amountRequested, 2) }} €
                    </div>
                    <div class="col-md-6">
                        <strong>Durée du prêt:</strong>
                        {{ $loanRequest->loan_duration }} mois
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Type d'agriculture:</strong>
                        {{ $loanRequest->farm_type }}
                    </div>
                    <div class="col-md-6">
                        <strong>Superficie:</strong>
                        {{ $loanRequest->land_size }} hectares
                    </div>
                </div>

                <div class="mb-3">
                    <strong>Objectif du prêt:</strong>
                    <div class="border p-3 mt-2 rounded bg-light">
                        {{ $loanRequest->purpose }}
                    </div>
                </div>

                <div class="mb-3">
                    <strong>Description du projet:</strong>
                    <div class="border p-3 mt-2 rounded bg-light">
                        {{ $loanRequest->project_description }}
                    </div>
                </div>

                @if($loanRequest->additional_notes)
                <div class="mb-3">
                    <strong>Notes supplémentaires:</strong>
                    <div class="border p-3 mt-2 rounded bg-light">
                        {{ $loanRequest->additional_notes }}
                    </div>
                </div>
                @endif
            </div>
        </div>

        <!-- Documents -->
        <div class="card mt-4">
            <div class="card-header bg-info text-white">
                <h4 class="mb-0">Documents</h4>
            </div>
            <div class="card-body">
                @if($loanRequest->documents->count() > 0)
                    <div class="list-group">
                        @foreach($loanRequest->documents as $document)
                            <div class="list-group-item d-flex justify-content-between align-items-center">
                                <div>
                                    <i class="fas fa-file-pdf text-danger me-2"></i>
                                    {{ $document->file_name }}
                                    <small class="text-muted d-block">Type: {{ $document->document_type }}</small>
                                </div>
                                <div>
                                    <span class="badge bg-secondary me-2">
                                        {{ \Carbon\Carbon::parse($document->uploaded_at)->format('d/m/Y') }}
                                    </span>
                                    <a href="{{ route('agent.loan-requests.download-document', $document) }}" 
                                    class="btn btn-sm btn-outline-primary" title="Télécharger le document">
                                        <i class="fas fa-download"></i>
                                    </a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">Aucun document disponible.</p>
                @endif
            </div>
        </div>

        <!-- Notes -->
        <div class="card mt-4">
            <div class="card-header bg-secondary text-white">
                <h4 class="mb-0">Notes</h4>
            </div>
            <div class="card-body">
                @if($loanRequest->notes->count() > 0)
                    <div class="list-group">
                        @foreach($loanRequest->notes as $note)
                            <div class="list-group-item">
                                <p class="mb-1">{{ $note->content }}</p>
                                <small class="text-muted">{{ \Carbon\Carbon::parse($note->created_at)->format('d/m/Y H:i') }}</small>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">Aucune note.</p>
                @endif
            </div>
        </div>

        <!-- Formulaire d'action -->
        @if(in_array($loanRequest->status, ['submitted', 'under_review', 'pending']))
            <div class="card mt-4" id="review">
                <div class="card-header bg-warning text-white">
                    <h4 class="mb-0">Examiner la demande</h4>
                </div>
                <div class="card-body">
                    <!-- Changement de statut -->
                    <form method="POST" action="{{ route('agent.loan-requests.update-status', $loanRequest->id) }}" class="mb-4">
                        @csrf
                        <div class="mb-3">
                            <label for="status" class="form-label">Changer le statut</label>
                            <select class="form-select @error('status') is-invalid @enderror" 
                                    id="status" name="status" required>
                                <option value="">Sélectionner un statut</option>
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>En attente</option>
                                <option value="under_review" {{ old('status') == 'under_review' ? 'selected' : '' }}>En revue</option>
                                <option value="approved" {{ old('status') == 'approved' ? 'selected' : '' }}>Approuvé</option>
                                <option value="rejected" {{ old('status') == 'rejected' ? 'selected' : '' }}>Rejeté</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="comment" class="form-label">Commentaire</label>
                            <textarea class="form-control @error('comment') is-invalid @enderror" 
                                      id="comment" name="comment" rows="3" required
                                      placeholder="Raison du changement de statut...">{{ old('comment') }}</textarea>
                            @error('comment')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-warning">
                            <i class="fas fa-sync-alt"></i> Mettre à jour le statut
                        </button>
                    </form>

                    <!-- Demande de documents -->
                    <form method="POST" action="{{ route('agent.loan-requests.request-documents', $loanRequest->id) }}">
                        @csrf
                        <div class="mb-3">
                            <label class="form-label">Documents demandés</label>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="requested_documents[]" value="Carte d'identité" id="doc1">
                                <label class="form-check-label" for="doc1">Carte d'identité</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="requested_documents[]" value="Justificatif de domicile" id="doc2">
                                <label class="form-check-label" for="doc2">Justificatif de domicile</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="requested_documents[]" value="Relevés bancaires" id="doc3">
                                <label class="form-check-label" for="doc3">Relevés bancaires</label>
                            </div>
                            <div class="form-check">
                                <input class="form-check-input" type="checkbox" name="requested_documents[]" value="Titre de propriété" id="doc4">
                                <label class="form-check-label" for="doc4">Titre de propriété</label>
                            </div>
                        </div>
                        <div class="mb-3">
                            <label for="message" class="form-label">Message</label>
                            <textarea class="form-control @error('message') is-invalid @enderror" 
                                      id="message" name="message" rows="3" required
                                      placeholder="Message accompagnant la demande de documents...">{{ old('message') }}</textarea>
                            @error('message')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-info text-white">
                            <i class="fas fa-file-import"></i> Demander des documents
                        </button>
                    </form>
                </div>
            </div>
        @endif

        <!-- Ajout de note -->
        <div class="card mt-4">
            <div class="card-header bg-light">
                <h4 class="mb-0">Ajouter une note</h4>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('agent.loan-requests.add-note', $loanRequest->id) }}">
                    @csrf
                    <div class="mb-3">
                        <label for="content" class="form-label">Note</label>
                        <textarea class="form-control @error('content') is-invalid @enderror" 
                                  id="content" name="content" rows="3" required
                                  placeholder="Ajouter une note interne...">{{ old('content') }}</textarea>
                        @error('content')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <button type="submit" class="btn btn-secondary">
                        <i class="fas fa-plus"></i> Ajouter la note
                    </button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <!-- Actions -->
        <div class="card">
            <div class="card-header bg-light">
                <h5 class="mb-0">Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('agent.loan-requests') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left"></i> Retour aux demandes
                    </a>
                    <a href="{{ route('agent.dashboard') }}" class="btn btn-outline-secondary">
                        <i class="fas fa-home"></i> Dashboard
                    </a>
                </div>
            </div>
        </div>

        <!-- Informations -->
        <div class="card mt-4">
            <div class="card-header bg-secondary text-white">
                <h5 class="mb-0">Informations</h5>
            </div>
            <div class="card-body">
                <p><strong>Référence:</strong> #{{ $loanRequest->id }}</p>
                <p><strong>Créée le:</strong> {{ $loanRequest->created_at->format('d/m/Y H:i') }}</p>
                <p><strong>Dernière mise à jour:</strong> {{ $loanRequest->updated_at->format('d/m/Y H:i') }}</p>
                <p><strong>Nombre de documents:</strong> {{ $loanRequest->documents->count() }}</p>
                <p><strong>Nombre de notes:</strong> {{ $loanRequest->notes->count() }}</p>
            </div>
        </div>
    </div>
</div>
@endsection