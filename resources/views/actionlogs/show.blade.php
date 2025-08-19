<!-- show.blade.php -->
@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Log Action #{{ $log->id }}</h1>
    <ul class="list-group mb-3">
        <li class="list-group-item"><strong>Action :</strong> {{ $log->action }}</li>
        <li class="list-group-item"><strong>Par :</strong> {{ $log->performedBy->fullName ?? '-' }}</li>
        <li class="list-group-item"><strong>Détails :</strong> {{ $log->details }}</li>
        <li class="list-group-item"><strong>Date :</strong> {{ $log->timestamp }}</li>
    </ul>
    <a href="{{ route('actionlogs.index') }}" class="btn btn-secondary">Retour</a>
</div>
@endsection
