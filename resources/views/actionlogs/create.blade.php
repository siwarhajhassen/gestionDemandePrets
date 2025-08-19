@extends('layouts.app')

@section('title', 'Ajouter une action')

@section('content')
    <div class="container">
        <h2>Nouvelle entrée dans l’historique</h2>

        <form action="{{ route('actionlogs.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="action">Action</label>
                <input type="text" name="action" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="performed_by">Utilisateur</label>
                <select name="performed_by" class="form-control" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->fullName }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="details">Détails</label>
                <textarea name="details" class="form-control" rows="4" required></textarea>
            </div>

            <button type="submit" class="btn btn-success">Ajouter</button>
        </form>
    </div>
@endsection
