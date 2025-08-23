@extends('layouts.app')

@section('title', 'Détails de la demande de prêt')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3>Détails de la demande #{{ $loanRequest->id }}</h3>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Statut:</strong>
                        <span class="badge bg-{{ $loanRequest->loan_status == 'approved' ? 'success' : ($loanRequest->loan_status == 'rejected' ? 'danger' : 'warning') }}">
                            {{ $loanRequest->loan_status }}
                        </span>
                    </div>
                    <div class="col-md-6">
                        <strong>Date de soumission:</strong>
                        {{ $loanRequest->submission_date->format('d/m/Y H:i') }}
                    </div>
                </div>

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Montant demandé:</strong>
                        {{ number_format($loanRequest->amount_requested, 2) }} €
                    </div>
                    <div class="col-md-6">
                        <strong>Dernière mise à jour:</strong>
                        {{ $loanRequest->last_updated->format('d/m/Y H:i') }}
                    </div>
                </div>

                <div class="mb-3">
                    <strong>Objectif:</strong>
                    <p class="mt-2">{{ $loanRequest->purpose }}</p>
                </div>

                @if($loanRequest->loan_status == 'draft')
                    <div class="d-flex gap-2">
                        <a href="{{ route('loan-requests.edit', $loanRequest->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Modifier
                        </a>
                        <form action="{{ route('loan-requests.submit', $loanRequest->id) }}" method="POST">
                            @csrf
                            <button type="submit" class="btn btn-success" 
                                    onclick="return confirm('Êtes-vous sûr de vouloir soumettre cette demande ?')">
                                <i class="fas fa-paper-plane"></i> Soumettre
                            </button>
                        </form>
                    </div>
                @endif
            </div>
        </div>

        <!-- Documents Section -->
        <div class="card mt-4">
            <div class="card-header">
                <h4>Documents</h4>
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
                                <span class="badge bg-secondary">
                                    {{ $document->uploaded_at->format('d/m/Y') }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">Aucun document ajouté.</p>
                @endif

                @if($loanRequest->loan_status == 'draft')
                    <hr>
                    <h5>Ajouter un document</h5>
                    <form method="POST" action="{{ route('loan-requests.add-document', $loanRequest->id) }}" 
                          enctype="multipart/form-data" class="mt-3">
                        @csrf
                        <div class="mb-3">
                            <label for="file" class="form-label">Fichier</label>
                            <input type="file" class="form-control @error('file') is-invalid @enderror" 
                                   id="file" name="file" required>
                            @error('file')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="type" class="form-label">Type de document</label>
                            <input type="text" class="form-control @error('type') is-invalid @enderror" 
                                   id="type" name="type" required>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-primary">Ajouter le document</button>
                    </form>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <!-- Notes Section -->
        <div class="card">
            <div class="card-header">
                <h4>Notes</h4>
            </div>
            <div class="card-body">
                @if($loanRequest->notes->count() > 0)
                    <div class="list-group">
                        @foreach($loanRequest->notes as $note)
                            <div class="list-group-item">
                                <p class="mb-1">{{ $note->content }}</p>
                                <small class="text-muted">{{ $note->created_at->format('d/m/Y H:i') }}</small>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">Aucune note.</p>
                @endif
            </div>
        </div>
    </div>
</div>
@endsection