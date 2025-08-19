<!-- show.blade.php -->
@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Note #{{ $note->id }}</h1>
    <ul class="list-group mb-3">
        <li class="list-group-item"><strong>Loan Request ID:</strong> {{ $note->loan_request_id }}</li>
        <li class="list-group-item"><strong>Agent:</strong> {{ $note->author->user->fullName ?? '-' }}</li>
        <li class="list-group-item"><strong>Contenu:</strong> {{ $note->content }}</li>
        <li class="list-group-item"><strong>Visibilité:</strong> {{ $note->visibility }}</li>
    </ul>
    <a href="{{ route('notes.index') }}" class="btn btn-secondary">Retour</a>
</div>
@endsection
