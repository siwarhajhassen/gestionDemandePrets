<!-- edit.blade.php -->
@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Modifier le Document #{{ $document->id }}</h1>
    <form method="POST" action="{{ route('documents.update', $document->id) }}" enctype="multipart/form-data">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Loan Request ID</label>
            <input type="number" name="loan_request_id" class="form-control" value="{{ $document->loan_request_id }}" required>
        </div>
        <div class="mb-3">
            <label>Fichier</label>
            <input type="file" name="file" class="form-control">
        </div>
        <div class="mb-3">
            <label>Type</label>
            <select name="type" class="form-control">
                <option value="ID_CARD" {{ $document->type=='ID_CARD'?'selected':'' }}>ID CARD</option>
                <option value="BANK_STATEMENT" {{ $document->type=='BANK_STATEMENT'?'selected':'' }}>Bank Statement</option>
                <option value="TAX_CERT" {{ $document->type=='TAX_CERT'?'selected':'' }}>Tax Certificate</option>
            </select>
        </div>
        <button class="btn btn-primary">Mettre à jour</button>
    </form>
</div>
@endsection
