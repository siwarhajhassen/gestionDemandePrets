@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier l'Agent BNA</h1>

    <form method="POST" action="{{ route('agents.update', $agent->id) }}">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label for="employeeId" class="form-label">Employee ID</label>
            <input type="text" class="form-control" id="employeeId" name="employeeId" value="{{ old('employeeId', $agent->employeeId) }}" required>
            @error('employeeId')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label for="fullName" class="form-label">Nom complet</label>
            <input type="text" class="form-control" id="fullName" name="fullName" value="{{ old('fullName', $agent->fullName) }}" required>
            @error('fullName')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label for="branch" class="form-label">Branche</label>
            <input type="text" class="form-control" id="branch" name="branch" value="{{ old('branch', $agent->branch) }}" required>
            @error('branch')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email</label>
            <input type="email" class="form-control" id="email" name="email" value="{{ old('email', $agent->email) }}" required>
            @error('email')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <div class="mb-3">
            <label for="phone" class="form-label">Téléphone</label>
            <input type="text" class="form-control" id="phone" name="phone" value="{{ old('phone', $agent->phone) }}">
            @error('phone')<div class="text-danger">{{ $message }}</div>@enderror
        </div>
        <button type="submit" class="btn btn-primary">Mettre à jour</button>
        <a href="{{ route('agents.index') }}" class="btn btn-secondary">Annuler</a>
    </form>
</div>
@endsection
