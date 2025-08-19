<!-- edit.blade.php -->
@extends('layouts.app')
@section('content')
<div class="container">
    <h1>Modifier la note #{{ $note->id }}</h1>
    <form method="POST" action="{{ route('notes.update', $note->id) }}">
        @csrf @method('PUT')
        <div class="mb-3">
            <label>Contenu</label>
            <textarea name="content" class="form-control" rows="3" required>{{ $note->content }}</textarea>
        </div>
        <div class="mb-3">
            <label>Visibilité</label>
            <select name="visibility" class="form-control">
                <option value="INTERNAL" {{ $note->visibility=='INTERNAL'? 'selected':'' }}>INTERNAL</option>
                <option value="SHARED_WITH_APPLICANT" {{ $note->visibility=='SHARED_WITH_APPLICANT'? 'selected':'' }}>SHARED_WITH_APPLICANT</option>
            </select>
        </div>
        <button class="btn btn-primary">Enregistrer</button>
    </form>
</div>
@endsection
