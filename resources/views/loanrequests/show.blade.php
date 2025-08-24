@extends('layouts.app')

@section('title', 'Détails de la demande de prêt #' . $loanRequest->id)

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h3 class="mb-0">Détails de la demande de prêt #{{ $loanRequest->id }}</h3>
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

                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Date de début prévue:</strong>
                        @if($loanRequest->expected_start_date)
                            {{ \Carbon\Carbon::parse($loanRequest->expected_start_date)->format('d/m/Y') }}
                        @else
                            <span class="text-muted">Non définie</span>
                        @endif
                    </div>
                    <div class="col-md-6">
                        <strong>Date d'achèvement prévue:</strong>
                        @if($loanRequest->expected_completion_date)
                            {{ \Carbon\Carbon::parse($loanRequest->expected_completion_date)->format('d/m/Y') }}
                        @else
                            <span class="text-muted">Non définie</span>
                        @endif
                    </div>
                </div>

                <div class="mb-3">
                    <strong>Objectif du prêt:</strong>
                    <p class="mt-2">{{ $loanRequest->purpose }}</p>
                </div>

                <div class="mb-3">
                    <strong>Description du projet:</strong>
                    <p class="mt-2">{{ $loanRequest->project_description }}</p>
                </div>

                @if($loanRequest->additional_notes)
                <div class="mb-3">
                    <strong>Notes supplémentaires:</strong>
                    <p class="mt-2">{{ $loanRequest->additional_notes }}</p>
                </div>
                @endif

                @if($loanRequest->status == 'draft')
                    <div class="d-flex gap-2 mt-4">
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
                                <span class="badge bg-secondary">
                                    {{ \Carbon\Carbon::parse($document->uploaded_at)->format('d/m/Y') }}
                                </span>
                            </div>
                        @endforeach
                    </div>
                @else
                    <p class="text-muted">Aucun document ajouté.</p>
                @endif
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <!-- Notes Section -->
        <div class="card">
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

        <!-- Actions Section -->
        <div class="card mt-4">
            <div class="card-header bg-light">
                <h5 class="mb-0">Actions</h5>
            </div>
            <div class="card-body">
                <div class="d-grid gap-2">
                    <a href="{{ route('loan-requests.index') }}" class="btn btn-outline-primary">
                        <i class="fas fa-arrow-left"></i> Retour à la liste
                    </a>
                    
                    @if($loanRequest->status == 'draft')
                        <a href="{{ route('loan-requests.edit', $loanRequest->id) }}" class="btn btn-warning">
                            <i class="fas fa-edit"></i> Modifier la demande
                        </a>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection