@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier l'action #{{ $actionlog->id }}</h1>

    <form method="POST" action="{{ route('actionlogs.update', $actionlog->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="action" class="form-label">Action</label>
            <input type="text" name="action" class="form-control" value="{{ old('action', $actionlog->action) }}" required>
            @error('action')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <div class="mb-3">
            <label for="details" class="form-label">Détails</label>
            <textarea name="details" class="form-control" rows="4" required>{{ old('details', $actionlog->details) }}</textarea>
            @error('details')<div class="text-danger">{{ $message }}</div>@enderror
        </div>

        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('actionlogs.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
