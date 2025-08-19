@extends('layouts.app')

@section('title', 'Ajouter un Document')

@section('content')
    <div class="container">
        <h2>Ajouter un document à une demande</h2>

        <form action="{{ route('documents.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <div class="mb-3">
                <label for="loan_request_id">Demande de Prêt</label>
                <select name="loan_request_id" class="form-control" required>
                    @foreach($loanRequests as $request)
                        <option value="{{ $request->id }}">Demande #{{ $request->id }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="type">Type de Document</label>
                <select name="type" class="form-control">
                    <option value="ID_CARD">Carte d'identité</option>
                    <option value="BANK_STATEMENT">Relevé bancaire</option>
                    <option value="LAND_REGISTRATION">Titre foncier</option>
                </select>
            </div>

            <div class="mb-3">
                <label for="file">Fichier</label>
                <input type="file" name="file" class="form-control" required>
            </div>

            <button type="submit" class="btn btn-success">Téléverser</button>
        </form>
    </div>
@endsection

