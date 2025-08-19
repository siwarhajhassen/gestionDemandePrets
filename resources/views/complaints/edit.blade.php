@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier Réclamation #{{ $complaint->id }}</h1>

    <form action="{{ route('complaints.update', $complaint->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="form-group">
            <label for="author_id">Auteur</label>
            <select name="author_id" id="author_id" class="form-control @error('author_id') is-invalid @enderror">
                <option value="">-- Choisir un utilisateur --</option>
                @foreach($users as $user)
                    <option value="{{ $user->id }}" {{ ($complaint->author_id == $user->id) ? 'selected' : '' }}>
                        {{ $user->fullName }}
                    </option>
                @endforeach
            </select>
            @error('author_id')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mt-3">
            <label for="subject">Sujet</label>
            <input type="text" name="subject" id="subject" class="form-control @error('subject') is-invalid @enderror" value="{{ old('subject', $complaint->subject) }}">
            @error('subject')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mt-3">
            <label for="message">Message</label>
            <textarea name="message" id="message" rows="4" class="form-control @error('message') is-invalid @enderror">{{ old('message', $complaint->message) }}</textarea>
            @error('message')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="form-group mt-3">
            <label for="status">Statut</label>
            <select name="status" id="status" class="form-control @error('status') is-invalid @enderror">
                <option value="OPEN" {{ $complaint->status == 'OPEN' ? 'selected' : '' }}>Ouvert</option>
                <option value="RESPONDED" {{ $complaint->status == 'RESPONDED' ? 'selected' : '' }}>Répondu</option>
                <option value="CLOSED" {{ $complaint->status == 'CLOSED' ? 'selected' : '' }}>Fermé</option>
            </select>
            @error('status')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary mt-4">Mettre à jour</button>
        <a href="{{ route('complaints.index') }}" class="btn btn-secondary mt-4">Annuler</a>
    </form>
</div>
@endsection
