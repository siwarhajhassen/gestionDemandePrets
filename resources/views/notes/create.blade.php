@extends('layouts.app')

@section('title', 'Créer une Note Interne')

@section('content')
    <div class="container">
        <h2>Nouvelle Note Interne</h2>

        <form action="{{ route('notes.store') }}" method="POST">
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
                <label for="content">Contenu</label>
                <textarea name="content" class="form-control" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label for="visibility">Visibilité</label>
                <select name="visibility" class="form-control">
                    <option value="INTERNAL">Interne</option>
                    <option value="SHARED_WITH_APPLICANT">Partagée avec le client</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Ajouter</button>
        </form>
    </div>
@endsection
