@extends('layouts.app')

@section('title', 'Nouvelle Demande de Prêt')

@section('content')
<div class="container">
    <h2>Nouvelle Demande de Prêt</h2>

    <form action="{{ route('loanrequests.store') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="applicant_id">Agriculteur</label>
            <select name="applicant_id" class="form-control" required>
                @foreach($agriculteurs as $agriculteur)
                    <option value="{{ $agriculteur->id }}">{{ $agriculteur->fullName }}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="amountRequested">Montant demandé</label>
            <input type="number" step="0.01" name="amountRequested" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="purpose">Objet du prêt</label>
            <input type="text" name="purpose" class="form-control" required>
        </div>

        <div class="mb-3">
            <label for="status">Statut</label>
            <select name="status" class="form-control">
                <option value="DRAFT">DRAFT</option>
                <option value="SUBMITTED">SUBMITTED</option>
                <option value="IN_REVIEW">IN REVIEW</option>
                <option value="APPROVED">APPROVED</option>
                <option value="REJECTED">REJECTED</option>
                <option value="INCOMPLETE">INCOMPLETE</option>
            </select>
        </div>

        <button type="submit" class="btn btn-success">Soumettre</button>
    </form>
</div>
@endsection
