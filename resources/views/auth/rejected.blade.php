@extends('layouts.app')

@section('title', 'Compte Rejeté')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Compte Rejeté</h3>
            </div>
            <div class="card-body text-center">
                <div class="mb-4">
                    <i class="fas fa-times-circle fa-4x text-danger"></i>
                </div>
                <h4>Votre compte a été rejeté</h4>
                @if(isset($reason))
                <div class="alert alert-info mt-3">
                    <strong>Raison :</strong> {{ $reason }}
                </div>
                @endif
                <p class="text-muted mt-3">
                    Pour plus d'informations, veuillez contacter l'administration.
                </p>
                <div class="mt-4">
                    <a href="{{ route('login') }}" class="btn btn-primary">
                        <i class="fas fa-sign-in-alt"></i> Retour à la connexion
                    </a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection