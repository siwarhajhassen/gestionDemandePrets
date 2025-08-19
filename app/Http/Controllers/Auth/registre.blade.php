@extends('layouts.app')

@section('content')
<div class="container mt-5" style="max-width: 600px;">
    <h2 class="mb-4 text-success">Inscription - Plateforme Prêts BNA</h2>

    @if ($errors->any())
        <div class="alert alert-danger">
            <ul class="mb-0">
                @foreach ($errors->all() as $error)
                  <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <div class="mb-3">
            <label for="username" class="form-label">Nom d'utilisateur</label>
            <input id="username" type="text" class="form-control" name="username" value="{{ old('username') }}" required autofocus>
        </div>

        <div class="mb-3">
            <label for="fullName" class="form-label">Nom complet</label>
            <input id="fullName" type="text" class="form-control" name="fullName" value="{{ old('fullName') }}" required>
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Adresse Email</label>
            <input id="email" type="email" class="form-control" name="email" value="{{ old('email') }}" required>
        </div>

        <div class="mb-3">
            <label for="phone" class="form-label">Téléphone (optionnel)</label>
            <input id="phone" type="tel" class="form-control" name="phone" value="{{ old('phone') }}">
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">Mot de passe</label>
            <input id="password" type="password" class="form-control" name="password" required>
        </div>

        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
            <input id="password_confirmation" type="password" class="form-control" name="password_confirmation" required>
        </div>

        <button type="submit" class="btn btn-success w-100">S'inscrire</button>
    </form>
</div>
@endsection
