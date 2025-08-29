@extends('layouts.guest')

@section('title', 'En Attente de Validation')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">En Attente de Validation</h3>
            </div>
            <div class="card-body text-center">
                <div class="mb-4">
                    <i class="fas fa-clock fa-4x text-warning"></i>
                </div>
                <h4>Votre compte est en cours de validation</h4>
                <p class="text-muted">
                    Votre inscription a été reçue et est en attente de validation administrative.
                    Vous recevrez un email une fois votre compte approuvé.
                </p>
                <div class="mt-4">
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="btn btn-primary">
                            <i class="fas fa-sign-out-alt"></i> Se déconnecter
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection