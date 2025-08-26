@extends('layouts.app')

@section('title', 'Inscription Agriculteur')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Inscription Agriculteur</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    
                    <!-- Champ caché pour le type d'utilisateur -->
                    <input type="hidden" name="user_type" value="agriculteur">
                    
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="nom" class="form-label">Nom</label>
                                <input type="text" class="form-control @error('nom') is-invalid @enderror" 
                                       id="nom" name="nom" value="{{ old('nom') }}" required>
                                @error('nom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="prenom" class="form-label">Prénom</label>
                                <input type="text" class="form-control @error('prenom') is-invalid @enderror" 
                                       id="prenom" name="prenom" value="{{ old('prenom') }}" required>
                                @error('prenom')
                                    <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>
                        </div>
                    </div>

                    <div class="mb-3">
                        <label for="email" class="form-label">Email</label>
                        <input type="email" class="form-control @error('email') is-invalid @enderror" 
                               id="email" name="email" value="{{ old('email') }}" required>
                        @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="num_tel" class="form-label">Numéro de téléphone</label>
                        <input type="tel" class="form-control @error('num_tel') is-invalid @enderror" 
                               id="num_tel" name="num_tel" value="{{ old('num_tel') }}" required>
                        @error('num_tel')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="username" class="form-label">Nom d'utilisateur</label>
                        <input type="text" class="form-control @error('username') is-invalid @enderror" 
                               id="username" name="username" value="{{ old('username') }}" required>
                        @error('username')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Mot de passe</label>
                        <input type="password" class="form-control @error('password') is-invalid @enderror" 
                               id="password" name="password" required>
                        @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password_confirmation" class="form-label">Confirmer le mot de passe</label>
                        <input type="password" class="form-control" id="password_confirmation" 
                               name="password_confirmation" required>
                    </div>

                    <!-- Choix de l'agence -->
                    <div class="mb-3">
                        <label for="agence_id" class="form-label">Agence</label>
                        <select class="form-select @error('agence_id') is-invalid @enderror" 
                                id="agence_id" name="agence_id" required>
                            <option value="">Sélectionner une agence</option>
                            @foreach($agences as $agence)
                                <option value="{{ $agence->id }}" {{ old('agence_id') == $agence->id ? 'selected' : '' }}>
                                    {{ $agence->name }} ({{ $agence->code }})
                                </option>
                            @endforeach
                        </select>
                        @error('agence_id')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Champs spécifiques agriculteur -->
                    <div id="agriculteur_fields">
                        <div class="mb-3">
                            <label for="cin" class="form-label">CIN</label>
                            <input type="text" class="form-control @error('cin') is-invalid @enderror" 
                                   id="cin" name="cin" value="{{ old('cin') }}" required>
                            @error('cin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="farm_address" class="form-label">Adresse de la ferme</label>
                            <textarea class="form-control @error('farm_address') is-invalid @enderror" 
                                      id="farm_address" name="farm_address" required>{{ old('farm_address') }}</textarea>
                            @error('farm_address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="farm_type" class="form-label">Type de ferme</label>
                            <select class="form-select @error('farm_type') is-invalid @enderror" 
                                    id="farm_type" name="farm_type" required>
                                <option value="">Sélectionner le type de ferme</option>
                                <option value="Élevage" {{ old('farm_type') == 'Élevage' ? 'selected' : '' }}>Élevage</option>
                                <option value="Céréales" {{ old('farm_type') == 'Céréales' ? 'selected' : '' }}>Céréales</option>
                                <option value="Maréchage" {{ old('farm_type') == 'Maréchage' ? 'selected' : '' }}>Maréchage</option>
                                <option value="Arboriculture" {{ old('farm_type') == 'Arboriculture' ? 'selected' : '' }}>Arboriculture</option>
                                <option value="Viticulture" {{ old('farm_type') == 'Viticulture' ? 'selected' : '' }}>Viticulture</option>
                                <option value="Autre" {{ old('farm_type') == 'Autre' ? 'selected' : '' }}>Autre</option>
                            </select>
                            @error('farm_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">S'inscrire</button>
                </form>
                <div class="text-center mt-3">
                    <p>Déjà un compte ? <a href="{{ route('login') }}">Se connecter</a></p>
                </div>
                
                <!-- Information sur le processus de validation -->
                <div class="alert alert-info mt-3">
                    <h6><i class="fas fa-info-circle"></i> Processus d'inscription</h6>
                    <p class="mb-0 small">
                        Votre inscription sera soumise à une validation administrative. 
                        Vous recevrez une notification une fois votre compte approuvé.
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    // Le script n'est plus nécessaire car on n'a qu'un seul type d'utilisateur
    document.addEventListener('DOMContentLoaded', function() {
        // Afficher les champs agriculteur par défaut
        document.getElementById('agriculteur_fields').style.display = 'block';
    });
</script>
@endsection