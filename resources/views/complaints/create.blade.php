@extends('layouts.app')

@section('title', 'Créer une Réclamation')

@section('content')
    <div class="container">
        <h2>Nouvelle Réclamation</h2>

        <form action="{{ route('complaints.store') }}" method="POST">
            @csrf

            <div class="mb-3">
                <label for="author_id">Auteur (Agriculteur)</label>
                <select name="author_id" class="form-control" required>
                    @foreach($users as $user)
                        <option value="{{ $user->id }}">{{ $user->fullName }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mb-3">
                <label for="subject">Sujet</label>
                <input type="text" name="subject" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="message">Message</label>
                <textarea name="message" class="form-control" rows="4" required></textarea>
            </div>

            <div class="mb-3">
                <label for="status">Statut</label>
                <select name="status" class="form-control">
                    <option value="OPEN">OPEN</option>
                    <option value="RESPONDED">RESPONDED</option>
                    <option value="CLOSED">CLOSED</option>
                </select>
            </div>

            <button type="submit" class="btn btn-success">Envoyer</button>
        </form>
    </div>
@endsection

