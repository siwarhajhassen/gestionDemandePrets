@extends('layouts.app')

@section('title', 'Modifier la demande de prêt')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Modifier la demande #{{ $loanRequest->id }}</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('loan-requests.update', $loanRequest->id) }}">
                    @csrf
                    @method('PUT')
                    <div class="mb-3">
                        <label for="amount_requested" class="form-label">Montant demandé (€)</label>
                        <input type="number" step="0.01" class="form-control @error('amount_requested') is-invalid @enderror" 
                               id="amount_requested" name="amount_requested" 
                               value="{{ old('amount_requested', $loanRequest->amount_requested) }}" required>
                        @error('amount_requested')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="purpose" class="form-label">Objectif du prêt</label>
                        <textarea class="form-control @error('purpose') is-invalid @enderror" 
                                  id="purpose" name="purpose" rows="4" required>{{ old('purpose', $loanRequest->purpose) }}</textarea>
                        @error('purpose')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="d-grid gap-2">
                        <button type="submit" class="btn btn-primary">Mettre à jour</button>
                        <a href="{{ route('loan-requests.show', $loanRequest->id) }}" class="btn btn-secondary">Annuler</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection