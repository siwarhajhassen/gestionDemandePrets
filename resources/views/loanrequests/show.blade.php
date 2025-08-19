@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Détails - Demande #{{ $loanrequest->id }}</h1>
    <ul class="list-group mb-3">
        <li class="list-group-item"><strong>Agriculteur :</strong> {{ $loanrequest->agriculteur->fullName }}</li>
        <li class="list-group-item"><strong>Montant :</strong> {{ number_format($loanrequest->amountRequested,2) }}</li>
        <li class="list-group-item"><strong>Objet :</strong> {{ $loanrequest->purpose }}</li>
        <li class="list-group-item"><strong>Statut :</strong> {{ $loanrequest->status }}</li>
        <li class="list-group-item"><strong>Date de soumission :</strong> {{ $loanrequest->submissionDate }}</li>
        <li class="list-group-item"><strong>Dernière mise à jour :</strong> {{ $loanrequest->lastUpdated }}</li>
    </ul>
    <a href="{{ route('loanrequests.index') }}" class="btn btn-secondary">Retour</a>
</div>
@endsection
