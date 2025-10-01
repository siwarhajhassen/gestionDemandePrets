<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion - Banque Nationale Agricole</title>
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
        
        .login-container {
            background-color: white;
            border-radius: 12px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.08);
            overflow: hidden;
            width: 100%;
            max-width: 450px;
            z-index: 10;
            position: relative;
            border: 1px solid #e0e0e0;
        }
        
        .login-header {
            background: linear-gradient(135deg, var(--bna-green) 0%, var(--bna-dark-green) 100%);
            color: white;
            padding: 25px 20px;
            text-align: center;
            position: relative;
        }
        
        .login-header::after {
            content: '';
            position: absolute;
            bottom: 0;
            left: 0;
            width: 100%;
            height: 3px;
            background-color: var(--bna-gold);
        }
        
        .login-header h3 {
            margin: 0;
            font-weight: 600;
            font-size: 1.6rem;
            letter-spacing: 0.5px;
        }
        
        .login-body {
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
        
        .btn-login {
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
        
        .btn-login:hover {
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
        
        .register-link {
            color: var(--bna-green);
            text-decoration: none;
            font-weight: 500;
        }
        
        .register-link:hover {
            color: var(--bna-dark-green);
            text-decoration: underline;
        }
        
        .forgot-link {
            color: var(--bna-green);
            text-decoration: none;
            font-weight: 500;
            font-size: 0.9rem;
        }
        
        .forgot-link:hover {
            color: var(--bna-dark-green);
            text-decoration: underline;
        }
        
        .bna-logo {
            width: 100px;
            margin-bottom: 15px;
        }
        
        .login-footer {
            text-align: center;
            padding: 20px;
            background-color: #f9f9f9;
            border-top: 1px solid #eee;
            font-size: 0.85rem;
            color: #777;
        }
        
        .login-footer a {
            color: var(--bna-green);
            text-decoration: none;
        }
        
        .login-footer a:hover {
            text-decoration: underline;
        }
        
        .security-note {
            display: flex;
            align-items: center;
            justify-content: center;
            margin-top: 20px;
            font-size: 0.85rem;
            color: #666;
        }
        
        .security-note i {
            color: var(--bna-green);
            margin-right: 8px;
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
    
    <div class="login-container animate-fadeIn">
        <div class="login-header">
            <img src="{{ asset('images/logobnaapp.jpeg') }}" alt="Logo BNA" class="bna-logo">
            <h3><i class="fas fa-lock me-2"></i>Connexion</h3>
        </div>
        <div class="login-body">
            <form method="POST" action="{{ route('login') }}">
                @csrf
                
                <div class="mb-4 input-icon">
                    <i class="fas fa-user"></i>
                    <input type="text" class="form-control @error('username') is-invalid @enderror" 
                           id="username" name="username" value="{{ old('username') }}" required
                           placeholder="Nom d'utilisateur">
                    @error('username')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-4 input-icon">
                    <i class="fas fa-key"></i>
                    <input type="password" class="form-control @error('password') is-invalid @enderror" 
                           id="password" name="password" required placeholder="Mot de passe">
                    <span class="password-toggle" id="togglePassword">
                        <i class="fas fa-eye"></i>
                    </span>
                    @error('password')
                        <div class="invalid-feedback">{{ $message }}</div>
                    @enderror
                </div>
                
                <div class="mb-4 form-check d-flex justify-content-between align-items-center">
                    <div>
                        <input type="checkbox" class="form-check-input" id="remember" name="remember">
                        <label class="form-check-label" for="remember">Se souvenir de moi</label>
                    </div>
                    <a href="#" class="forgot-link">Mot de passe oublié?</a>
                </div>
                
                <button type="submit" class="btn btn-login mb-4">
                    <i class="fas fa-sign-in-alt me-2"></i>Se connecter
                </button>
                
                <div class="security-note">
                    <i class="fas fa-shield-alt"></i>
                    <span>Connexion sécurisée</span>
                </div>
            </form>
        </div>
        
        <div class="login-footer">
            <p>Pas encore de compte ? <a href="{{ route('register') }}" class="register-link">Créer un compte</a></p>
            <p class="mt-2">© 2025 Banque Nationale Agricole. Tous droits réservés.</p>
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
    </script>
</body>
</html>