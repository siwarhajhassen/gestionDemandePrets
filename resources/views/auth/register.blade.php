@extends('layouts.app')

@section('title', 'Inscription')

@section('content')
<div class="row justify-content-center">
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                <h3 class="text-center">Inscription</h3>
            </div>
            <div class="card-body">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
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

                    <div class="mb-3">
                        <label for="user_type" class="form-label">Type d'utilisateur</label>
                        <select class="form-select @error('user_type') is-invalid @enderror" 
                                id="user_type" name="user_type" required>
                            <option value="">Sélectionner un type</option>
                            <option value="agriculteur" {{ old('user_type') == 'agriculteur' ? 'selected' : '' }}>Agriculteur</option>
                            <option value="agent_bna" {{ old('user_type') == 'agent_bna' ? 'selected' : '' }}>Agent BNA</option>
                        </select>
                        @error('user_type')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- Agriculteur Fields -->
                    <div id="agriculteur_fields" style="display: none;">
                        <div class="mb-3">
                            <label for="cin" class="form-label">CIN</label>
                            <input type="text" class="form-control @error('cin') is-invalid @enderror" 
                                   id="cin" name="cin" value="{{ old('cin') }}">
                            @error('cin')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="farm_address" class="form-label">Adresse de la ferme</label>
                            <textarea class="form-control @error('farm_address') is-invalid @enderror" 
                                      id="farm_address" name="farm_address">{{ old('farm_address') }}</textarea>
                            @error('farm_address')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="farm_type" class="form-label">Type de ferme</label>
                            <input type="text" class="form-control @error('farm_type') is-invalid @enderror" 
                                   id="farm_type" name="farm_type" value="{{ old('farm_type') }}">
                            @error('farm_type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <!-- Agent BNA Fields -->
                    <div id="agent_bna_fields" style="display: none;">
                        <div class="mb-3">
                            <label for="employee_id" class="form-label">ID Employé</label>
                            <input type="text" class="form-control @error('employee_id') is-invalid @enderror" 
                                   id="employee_id" name="employee_id" value="{{ old('employee_id') }}">
                            @error('employee_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="mb-3">
                            <label for="agency_id" class="form-label">ID Agence</label>
                            <input type="text" class="form-control @error('agency_id') is-invalid @enderror" 
                                   id="agency_id" name="agency_id" value="{{ old('agency_id') }}">
                            @error('agency_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <button type="submit" class="btn btn-primary w-100">S'inscrire</button>
                </form>
                <div class="text-center mt-3">
                    <p>Déjà un compte ? <a href="{{ route('login') }}">Se connecter</a></p>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    document.getElementById('user_type').addEventListener('change', function() {
        const agriculteurFields = document.getElementById('agriculteur_fields');
        const agentBnaFields = document.getElementById('agent_bna_fields');
        
        agriculteurFields.style.display = this.value === 'agriculteur' ? 'block' : 'none';
        agentBnaFields.style.display = this.value === 'agent_bna' ? 'block' : 'none';
    });

    // Show fields if there are old values
    document.addEventListener('DOMContentLoaded', function() {
        const userType = document.getElementById('user_type').value;
        if (userType) {
            document.getElementById('user_type').dispatchEvent(new Event('change'));
        }
    });
</script>
@endsection