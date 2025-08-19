@extends('layouts.app')

@section('content')
<style>
    body, html {
        height: 100%;
        background-color: #e6f4ea; /* vert clair doux */
    }
    .home-container {
        height: 100vh;
        display: flex;
        align-items: center;
        justify-content: center;
        text-align: center;
    }
    .home-card {
        background: white;
        padding: 40px 50px;
        border-radius: 15px;
        box-shadow: 0 8px 16px rgba(0,0,0,0.15);
        max-width: 480px;
        width: 100%;
    }
    .btn-success-custom {
        background-color: #2e7d32;
        border-color: #2e7d32;
    }
    .btn-success-custom:hover {
        background-color: #1b4d21;
        border-color: #1b4d21;
    }
</style>

<div class="home-container">
    <div class="home-card">
        <h1 class="display-4 mb-4 text-success">🌿 Bienvenue sur BNA Agriculture</h1>
        <p class="lead mb-4 text-secondary">
            Gérez vos agriculteurs, agents, prêts, documents, plaintes et bien plus.
        </p>

        @guest
            <a href="{{ route('login') }}" class="btn btn-success btn-success-custom btn-lg me-3">Se connecter</a>
            <a href="{{ route('register') }}" class="btn btn-outline-success btn-lg">Créer un compte</a>
        @else
            <a href="{{ route('dashboard') }}" class="btn btn-success btn-success-custom btn-lg">Tableau de bord</a>
        @endguest
    </div>
</div>
@endsection
