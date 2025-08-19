@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier la demande de prêt</h1>

    <form method="POST" action="{{ route('loanrequests.update', $loanrequest->id) }}">
        @csrf @method('PUT')

        <div class="mb-3">
            <label>Montant demandé</label>
            <input type="number" step="0.01" name="amountRequested" class="form-control" value="{{ old('amountRequested', $loanrequest->amountRequested) }}" required>
            @error('amountRequested')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label>Objet du prêt</label>
            <input type="text" name="purpose" class="form-control" value="{{ old('purpose', $loanrequest->purpose) }}" required>
            @error('purpose')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <button class="btn btn-primary">Enregistrer</button>
    </form>
</div>
@endsection
