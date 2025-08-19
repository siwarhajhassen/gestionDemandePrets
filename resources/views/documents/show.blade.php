<!-- show.blade.php -->
@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Détails Document #{{ $document->id }}</h1>
    <ul class="list-group mb-3">
        <li class="list-group-item"><strong>Loan Request ID:</strong> {{ $document->loan_request_id }}</li>
        <li class="list-group-item"><strong>Nom fichier:</strong> {{ $document->fileName }}</li>
        <li class="list-group-item"><strong>Type:</strong> {{ $document->type }}</li>
        <li class="list-group-item"><strong>Téléchargé le:</strong> {{ $document->uploadedAt }}</li>
    </ul>
    <a href="{{ route('documents.index') }}" class="btn btn-secondary">Retour</a>
</div>
@endsection
