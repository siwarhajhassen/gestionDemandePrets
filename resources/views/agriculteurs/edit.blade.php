@extends('layouts.app')

@section('content')
<div class="container">
    <h1>Modifier Agriculteur</h1>

    <form action="{{ route('agriculteurs.update', $agriculteur->id) }}" method="POST">
        @csrf
        @method('PUT')

        <div class="mb-3">
            <label>Nom complet</label>
            <input type="text" name="fullName" class="form-control" value="{{ $agriculteur->fullName }}">
        </div>
        <div class="mb-3">
            <label>Email</label>
            <input type="email" name="email" class="form-control" value="{{ $agriculteur->email }}">
        </div>
        <div class="mb-3">
            <label>Identifiant National</label>
            <input type="text" name="nationalId" class="form-control" value="{{ $agriculteur->nationalId }}">
        </div>
        <div class="mb-3">
            <label>Adresse de la ferme</label>
            <input type="text" name="farmAddress" class="form-control" value="{{ $agriculteur->farmAddress }}">
        </div>
        <div class="mb-3">
            <label>Type de ferme</label>
            <input type="text" name="farmType" class="form-control" value="{{ $agriculteur->farmType }}">
        </div>
        <button class="btn btn-success">Enregistrer</button>
    </form>
</div>
@endsection
