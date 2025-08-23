@extends('layouts.app')

@section('title', 'Détails de la réclamation')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3>Réclamation: {{ $complaint->subject }}</h3>
            </div>
            <div class="card-body">
                <div class="row mb-3">
                    <div class="col-md-6">
                        <strong>Statut:</strong>
                        <span class="badge bg-{{ $complaint->status == 'resolved' ? 'success' : 'warning' }}">
                            {{ $complaint->status }}
                        </span>
                    </div>
                    <div class="col-md-6">
                        <strong>Date:</strong>
                        {{ $complaint->created_at->format('d/m/Y H:i') }}
                    </div>
                </div>

                <div class="mb-3">
                    <strong>Message:</strong>
                    <p class="mt-2">{{ $complaint->message }}</p>
                </div>
            </div>
        </div>

        <!-- Responses Section -->
        @if($complaint->responses->count() > 0)
            <div class="card mt-4">
                <div class="card-header">
                    <h4>Réponses</h4>
                </div>
                <div class="card-body">
                    <div class="list-group">
                        @foreach($complaint->responses as $response)
                            <div class="list-group-item">
                                <div class="d-flex w-100 justify-content-between">
                                    <h6 class="mb-1">Réponse de l'agent BNA</h6>
                                    <small>{{ $response->created_at->format('d/m/Y H:i') }}</small>
                                </div>
                                <p class="mb-1">{{ $response->message }}</p>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        @endif
    </div>
</div>
@endsection