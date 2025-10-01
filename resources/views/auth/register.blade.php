<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription Agriculteur - Banque Nationale Agricole</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    <style>
        :root {
            --bna-green: #56A875;
            --bna-dark-green: #3d8a5c;
            --bna-light-green: #e9f4ec;
            --bna-gold: #c6a568;
            --bna-dark: #333333;
            --bna-orange: #f97316;
        }
        
        body {
            background-color: #f5f9f6;
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            font-family: 'Roboto', sans-serif;
            padding: 20px;
            position: relative;
            overflow-x: hidden;
        }
        
        .bna-background {
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            z-index: 0;
            overflow: hidden;
            background: linear-gradient(135deg, var(--bna-light-green) 0%, #f5f9f6 100%);
        }
        
        .bna-pattern {
            position: absolute;
            top: 0;
            right: 0;
            width: 40%;
            height: 100%;
            background: 
                repeating-linear-gradient(
                    45deg,
                    transparent,
                    transparent 10px,
                    rgba(86, 168, 117, 0.03) 10px,
                    rgba(86, 168, 117, 0.03) 20px
                );
        }
        
        .register-container {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            width: 100%;
            max-width: 800px;
            z-index: 10;
            position: relative;
            border: 1px solid #e0e0e0;
        }
        
        .register-header {
            background: linear-gradient(135deg, var(--bna-green) 0%, var(--bna-dark-green) 100%);
            color: white;
            padding: 25px 20px;
            text-align: center;
            position: relative;
        }
        
        .register-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: var(--bna-gold);
        }
        
        .register-header h3 {
            margin: 0;
            font-weight: 600;
            font-size: 1.6rem;
            letter-spacing: 0.5px;
        }
        
        .register-body {
            padding: 30px;
        }
        
        .form-control {
            border-radius: 6px;
            padding: 14px 20px;
            border: 1px solid #ddd;
            transition: all 0.3s;
            font-size: 1rem;
            color: var(--bna-dark);
        }
        
        .form-control:focus {
            border-color: var(--bna-green);
            box-shadow: 0 0 0 3px rgba(86, 168, 117, 0.1);
        }
        
        .form-select {
            border-radius: 6px;
            padding: 14px 20px;
            border: 1px solid #ddd;
            transition: all 0.3s;
            font-size: 1rem;
            color: var(--bna-dark);
        }
        
        .form-select:focus {
            border-color: var(--bna-green);
            box-shadow: 0 0 0 3px rgba(86, 168, 117, 0.1);
        }
        
        textarea.form-control {
            min-height: 100px;
        }
        
        .input-icon {
            position: relative;
        }
        
        .input-icon i {
            position: absolute;
            left: 15px;
            top: 14px;
            color: #888;
        }
        
        .input-icon input {
            padding-left: 45px;
        }
        
        .btn-register {
            background: linear-gradient(135deg, var(--bna-green) 0%, var(--bna-dark-green) 100%);
            border: none;
            color: white;
            padding: 14px;
            border-radius: 6px;
            font-weight: 500;
            width: 100%;
            transition: all 0.3s;
            font-size: 1.1rem;
            letter-spacing: 0.5px;
        }
        
        .btn-register:hover {
            background: linear-gradient(135deg, var(--bna-dark-green) 0%, #2d6e48 100%);
            transform: translateY(-2px);
            box-shadow: 0 5px 15px rgba(86, 168, 117, 0.2);
        }
        
        .password-toggle {
            position: absolute;
            right: 15px;
            top: 14px;
            cursor: pointer;
            color: #888;
        }
        
        .form-check-input:checked {
            background-color: var(--bna-green);
            border-color: var(--bna-green);
        }
        
        .login-link {
            color: var(--bna-green);
            text-decoration: none;
            font-weight: 500;
        }
        
        .login-link:hover {
            color: var(--bna-dark-green);
            text-decoration: underline;
        }
        
        .bna-logo {
            width: 100px;
            margin-bottom: 15px;
        }
        
        .register-footer {
            text-align: center;
            padding: 20px;
            background-color: #f9f9f9;
            border-top: 1px solid #eee;
            font-size: 0.85rem;
            color: #777;
        }
        
        .register-footer a {
            color: var(--bna-green);
            text-decoration: none;
        }
        
        .register-footer a:hover {
            text-decoration: underline;
        }
        
        .info-box {
            background-color: #fff8f0;
            border-left: 4px solid var(--bna-orange);
            padding: 15px;
            border-radius: 6px;
            margin-top: 20px;
        }
        
        .info-box h6 {
            color: var(--bna-orange);
            margin-bottom: 10px;
            font-weight: 600;
        }
        
        .info-box p {
            margin-bottom: 0;
            font-size: 0.9rem;
            color: #666;
        }
        
        .section-title {
            color: var(--bna-green);
            font-weight: 600;
            margin: 25px 0 15px;
            padding-bottom: 10px;
            border-bottom: 2px solid var(--bna-light-green);
            position: relative;
        }
        
        .section-title::after {
            content: '';
            position: absolute;
            bottom: -2px;
            left: 0;
            width: 60px;
            height: 2px;
            background-color: var(--bna-gold);
        }
        
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }
        
        .animate-fadeIn {
            animation: fadeIn 0.6s ease forwards;
        }
        
        .language-selector {
            position: absolute;
            top: 20px;
            right: 20px;
            z-index: 20;
        }
        
        .language-selector select {
            border: 1px solid #ddd;
            border-radius: 4px;
            padding: 6px 12px;
            background-color: white;
            color: #555;
            font-size: 0.9rem;
        }
        
        .step-indicator {
            display: flex;
            justify-content: center;
            margin-bottom: 25px;
        }
        
        .step {
            display: flex;
            flex-direction: column;
            align-items: center;
            padding: 0 15px;
            position: relative;
        }
        
        .step-number {
            width: 35px;
            height: 35px;
            border-radius: 50%;
            background-color: var(--bna-green);
            color: white;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            margin-bottom: 8px;
        }
        
        .step-text {
            font-size: 0.85rem;
            color: var(--bna-green);
            font-weight: 500;
        }
        
        .step-connector {
            position: absolute;
            top: 17px;
            left: -40%;
            width: 80%;
            height: 2px;
            background-color: #ddd;
            z-index: -1;
        }
        
        .step.active .step-number {
            background-color: var(--bna-dark-green);
        }
        
        @media (max-width: 768px) {
            .step {
                padding: 0 10px;
            }
            
            .step-text {
                font-size: 0.75rem;
            }
            
            .step-connector {
                left: -35%;
                width: 70%;
            }
        }
    </style>
</head>
<body>
    <div class="bna-background">
        <div class="bna-pattern"></div>
    </div>
    
    <div class="language-selector">
        <select>
            <option value="fr">FR</option>
            <option value="ar">AR</option>
        </select>
    </div>
    
    <div class="register-container animate-fadeIn">
        <div class="register-header">
            <img src="{{ asset('images/logobnaapp.jpeg') }}" alt="Logo BNA" class="bna-logo">
            <h3><i class="fas fa-user-plus me-2"></i>Inscription Agriculteur</h3>
        </div>
        <div class="register-body">
            <!-- Indicateur d'étapes -->
            <div class="step-indicator">
                <div class="step active">
                    <div class="step-number">1</div>
                    <div class="step-text">Informations personnelles</div>
                </div>
                <div class="step">
                    <div class="step-number">2</div>
                    <div class="step-text">Informations de connexion</div>
                    <div class="step-connector"></div>
                </div>
                <div class="step">
                    <div class="step-number">3</div>
                    <div class="step-text">Informations agricoles</div>
                    <div class="step-connector"></div>
                </div>
            </div>
            
            <form method="POST" action="{{ route('register') }}">
                @csrf
                
                <!-- Champ caché pour le type d'utilisateur -->
                <input type="hidden" name="user_type" value="agriculteur">
                
                <h4 class="section-title">Informations personnelles</h4>
                <div class="row">
                    <div class="col-md-6">
                        <div class="mb-3 input-icon">
                            <i class="fas fa-user"></i>
                            <input type="text" class="form-control @error('nom') is-invalid @enderror" 
                                   id="nom" name="nom" value="{{ old('nom') }}" required
                                   placeholder="Nom">
                            @error('nom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="mb-3 input-icon">
                            <i class="fas fa-user"></i>
                            <input type="text" class="form-control @error('prenom') is-invalid @enderror" 
                                   id="prenom" name="prenom" value="{{ old('prenom') }}" required
                                   placeholder="Prénom">
                            @error('prenom')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>
                </div>

                <div class="mb-3 input-icon">
                    <i class="fas fa-envelope"></i>
                    <input type="email" class="form-control @error('email') is-invalid @enderror" 
                           id="email" name="email" value="{{ old('email') }}" required
                           placeholder="Adresse email">
                    @error('email')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 input-icon">
                    <i class="fas fa-phone"></i>
                    <input type="tel" class="form-control @error('num_tel') is-invalid @enderror" 
                           id="num_tel" name="num_tel" value="{{ old('num_tel') }}" required
                           placeholder="Numéro de téléphone">
                    @error('num_tel')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <h4 class="section-title">Informations de connexion</h4>
                <div class="mb-3 input-icon">
                    <i class="fas fa-user-circle"></i>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" 
                           id="username" name="username" value="{{ old('username') }}" required
                           placeholder="Nom d'utilisateur">
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 input-icon">
                    <i class="fas fa-lock"></i>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           id="password" name="password" required placeholder="Mot de passe">
                    <span class="password-toggle" id="togglePassword">
                        <i class="fas fa-eye"></i>
                    </span>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>

                <div class="mb-3 input-icon">
                    <i class="fas fa-lock"></i>
                    <input type="password" class="form-control" id="password_confirmation" 
                           name="password_confirmation" required placeholder="Confirmer le mot de passe">
                    <span class="password-toggle" id="togglePasswordConfirmation">
                        <i class="fas fa-eye"></i>
                    </span>
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

                <h4 class="section-title">Informations agricoles</h4>
                <!-- Champs spécifiques agriculteur -->
                <div id="agriculteur_fields">
                    <div class="mb-3 input-icon">
                        <i class="fas fa-id-card"></i>
                        <input type="text" class="form-control @error('cin') is-invalid @enderror" 
                               id="cin" name="cin" value="{{ old('cin') }}" required
                               placeholder="Numéro CIN">
                        @error('cin')
                            <div class="invalid-feedback">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="mb-3">
                        <label for="farm_address" class="form-label">Adresse de la ferme</label>
                        <textarea class="form-control @error('farm_address') is-invalid @enderror" 
                                  id="farm_address" name="farm_address" required
                                  placeholder="Adresse complète de votre exploitation">{{ old('farm_address') }}</textarea>
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

                <button type="submit" class="btn-register mb-4">
                    <i class="fas fa-user-plus me-2"></i>Créer mon compte
                </button>
                
                <div class="text-center mt-3">
                    <p>Déjà un compte ? <a href="{{ route('login') }}" class="login-link">Se connecter</a></p>
                </div>
                
                <!-- Information sur le processus de validation -->
                <div class="info-box">
                    <h6><i class="fas fa-info-circle"></i> Processus d'inscription</h6>
                    <p>
                        Votre inscription sera soumise à une validation administrative. 
                        Vous recevrez une notification une fois votre compte approuvé.
                    </p>
                </div>
            </form>
        </div>
        
        <div class="register-footer">
            <p>© 2025 Banque Nationale Agricole. Tous droits réservés.</p>
        </div>
    </div>

    <script>
        // Fonctionnalité pour afficher/masquer le mot de passe
        document.getElementById('togglePassword').addEventListener('click', function() {
            const passwordInput = document.getElementById('password');
            const icon = this.querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
        
        document.getElementById('togglePasswordConfirmation').addEventListener('click', function() {
            const passwordInput = document.getElementById('password_confirmation');
            const icon = this.querySelector('i');
            
            if (passwordInput.type === 'password') {
                passwordInput.type = 'text';
                icon.classList.remove('fa-eye');
                icon.classList.add('fa-eye-slash');
            } else {
                passwordInput.type = 'password';
                icon.classList.remove('fa-eye-slash');
                icon.classList.add('fa-eye');
            }
        });
        
        // Afficher les champs agriculteur par défaut
        document.addEventListener('DOMContentLoaded', function() {
            document.getElementById('agriculteur_fields').style.display = 'block';
        });
    </script>
</body>
</html>