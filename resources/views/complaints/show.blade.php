@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Détails de la Réclamation #{{ $complaint->id }}</h1>

    <div class="mb-3">
        <strong>Auteur :</strong> {{ $complaint->author->fullName ?? 'N/A' }}
    </div>

    <div class="mb-3">
        <strong>Sujet :</strong> {{ $complaint->subject }}
    </div>

    <div class="mb-3">
        <strong>Message :</strong>
        <p>{{ $complaint->message }}</p>
    </div>

    <div class="mb-3">
        <strong>Statut :</strong> {{ $complaint->status }}
    </div>

    <div class="mb-3">
        <strong>Date de création :</strong> {{ $complaint->created_at->format('d/m/Y H:i') }}
    </div>

    @if($complaint->relatedLoanRequest)
    <div class="mb-3">
        <strong>Demande de prêt associée :</strong>
        <a href="{{ route('loanrequests.show', $complaint->relatedLoanRequest->id) }}">
            #{{ $complaint->relatedLoanRequest->id }} - {{ $complaint->relatedLoanRequest->purpose }}
        </a>
    </div>
    @endif

    <a href="{{ route('complaints.index') }}" class="btn btn-secondary">Retour à la liste</a>
</div>
@endsection

