<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BNA - @yield('title','Banque Nationale Agricole')</title>
     <link rel="icon" href="{{ asset('images/iconbna.png') }}" type="image/png">
    
    <!-- Tailwind CSS via CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script>
        tailwind.config = {
            theme: {
                extend: {
                    colors: {
                        primary: {
                            50: '#f0fdf4',
                            100: '#dcfce7',
                            200: '#bbf7d0',
                            300: '#86efac',
                            400: '#4ade80',
                            500: '#22c55e',
                            600: '#16a34a',
                            700: '#15803d',
                            800: '#166534',
                            900: '#14532d',
                        }
                    }
                }
            }
        }
    </script>
    
    <!-- Alpine.js via CDN -->
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>
    
    <!-- Font Awesome -->
    <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" rel="stylesheet">
    
    <!-- Styles personnalisés -->
    <style>
        /* === STYLES PERSONNALISÉS === */
        .btn-primary {
            background-color: #16a34a !important;
            color: white !important;
            padding: 0.5rem 1rem !important;
            border-radius: 0.5rem !important;
            font-weight: bold !important;
            transition: all 0.2s !important;
            display: inline-block !important;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1) !important;
        }
        .btn-primary:hover {
            background-color: #15803d !important;
            transform: translateY(-1px) !important;
            box-shadow: 0 6px 8px rgba(0, 0, 0, 0.15) !important;
        }
        
        .btn-secondary {
            background-color: #dcfce7 !important;
            color: #166534 !important;
            padding: 0.5rem 1rem !important;
            border-radius: 0.5rem !important;
            font-weight: 500 !important;
            transition: all 0.2s !important;
        }
        .btn-secondary:hover {
            background-color: #bbf7d0 !important;
        }
        
        .card-green {
            background: white !important;
            border-left: 4px solid #22c55e !important;
            border-radius: 0.75rem !important;
            padding: 1.5rem !important;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1) !important;
        }
        
        .nav-green {
            background-color: #6fce94ff !important;
            color: white !important;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1) !important;
        }
        
        .input-green {
            border: 1px solid #d1d5db !important;
            border-radius: 0.5rem !important;
            padding: 0.75rem 1rem !important;
            width: 100% !important;
            box-sizing: border-box !important;
            transition: all 0.2s !important;
        }
        .input-green:focus {
            outline: none !important;
            border-color: #22c55e !important;
            box-shadow: 0 0 0 3px rgba(34, 197, 94, 0.1) !important;
        }
        
        .badge-green {
            background-color: #dcfce7 !important;
            color: #166534 !important;
            padding: 0.25rem 0.75rem !important;
            border-radius: 9999px !important;
            font-size: 0.875rem !important;
            font-weight: 500 !important;
            display: inline-block !important;
        }
        
        .link-green {
            color: #16a34a !important;
            font-weight: 500 !important;
            transition: color 0.2s !important;
        }
        .link-green:hover {
            color: #15803d !important;
        }
        
        /* Navigation */
        .nav-link {
            color: #bbf7d0 !important;
            padding: 0.5rem 0.75rem !important;
            border-radius: 0.375rem !important;
            transition: all 0.2s !important;
            font-weight: 500 !important;
            text-decoration: none !important;
        }
        .nav-link:hover {
            color: white !important;
            background-color: rgba(255, 255, 255, 0.1) !important;
        }
        
        .mobile-nav-link {
            color: #bbf7d0 !important;
            padding: 0.5rem 0.75rem !important;
            border-radius: 0.375rem !important;
            transition: all 0.2s !important;
            display: block !important;
            text-decoration: none !important;
        }
        .mobile-nav-link:hover {
            color: white !important;
            background-color: rgba(255, 255, 255, 0.1) !important;
        }
        
        /* Alertes */
        .alert-success {
            background-color: #dcfce7 !important;
            border: 1px solid #bbf7d0 !important;
            color: #166534 !important;
            padding: 1rem !important;
            border-radius: 0.5rem !important;
            margin-bottom: 1rem !important;
        }
        
        .alert-error {
            background-color: #fee2e2 !important;
            border: 1px solid #fecaca !important;
            color: #dc2626 !important;
            padding: 1rem !important;
            border-radius: 0.5rem !important;
            margin-bottom: 1rem !important;
        }
        
        /* Utilitaires */
        .bg-gradient-nav {
            background: linear-gradient(135deg, #166534 0%, #14532d 100%) !important;
        }
        
        .bg-gradient-green {
            background: linear-gradient(135deg, #22c55e 0%, #16a34a 100%) !important;
        }
        
        body {
            background-color: #f0fdf4 !important;
            color: #1f2937 !important;
            min-height: 100vh !important;
            font-family: system-ui, -apple-system, sans-serif !important;
        }
        
        h1, h2, h3, h4, h5, h6 {
            color: #14532d !important;
            font-weight: bold !important;
        }
        
        h1 { font-size: 1.875rem !important; line-height: 2.25rem !important; }
        h2 { font-size: 1.5rem !important; line-height: 2rem !important; }
        h3 { font-size: 1.25rem !important; line-height: 1.75rem !important; }
        
        a {
            color: #16a34a !important;
            transition: color 0.2s !important;
            text-decoration: none !important;
        }
        a:hover {
            color: #15803d !important;
        }
        
        /* Container */
        .container {
            width: 100% !important;
            max-width: 1200px !important;
            margin-left: auto !important;
            margin-right: auto !important;
            padding-left: 1rem !important;
            padding-right: 1rem !important;
        }
        
        /* Flex utilities */
        .flex { display: flex !important; }
        .hidden { display: none !important; }
        .items-center { align-items: center !important; }
        .justify-between { justify-content: space-between !important; }
        .space-x-4 > * + * { margin-left: 1rem !important; }
        .space-y-2 > * + * { margin-top: 0.5rem !important; }
        
        /* Responsive */
        @media (max-width: 768px) {
            .md\\:hidden { display: none !important; }
            .md\\:flex { display: flex !important; }
        }
        
        /* Animations */
        .transition {
            transition-property: all !important;
            transition-timing-function: cubic-bezier(0.4, 0, 0.2, 1) !important;
            transition-duration: 150ms !important;
        }
        
        .duration-200 { transition-duration: 200ms !important; }
        
        /* Borders */
        .border-t { border-top-width: 1px !important; }
        .border-green-600 { border-color: #16a34a !important; }
        
        /* Text */
        .text-green-200 { color: #bbf7d0 !important; }
        .text-green-300 { color: #86efac !important; }
        .text-green-400 { color: #4ade80 !important; }
        .text-green-500 { color: #22c55e !important; }
        .text-green-700 { color: #15803d !important; }
        .text-green-900 { color: #14532d !important; }
        .text-white { color: white !important; }
        
        .font-bold { font-weight: bold !important; }
        .font-medium { font-weight: 500 !important; }
        
        /* Backgrounds */
        .bg-green-50 { background-color: #f0fdf4 !important; }
        .bg-green-100 { background-color: #dcfce7 !important; }
        .bg-green-800 { background-color: #166534 !important; }
        .bg-green-900 { background-color: #14532d !important; }
        .bg-red-100 { background-color: #fee2e2 !important; }
        
        /* Padding */
        .px-4 { padding-left: 1rem !important; padding-right: 1rem !important; }
        .py-4 { padding-top: 1rem !important; padding-bottom: 1rem !important; }
        .py-6 { padding-top: 1.5rem !important; padding-bottom: 1.5rem !important; }
        .py-8 { padding-top: 2rem !important; padding-bottom: 2rem !important; }
        .p-6 { padding: 1.5rem !important; }
        
        /* Margin */
        .mt-8 { margin-top: 2rem !important; }
        .mb-6 { margin-bottom: 1.5rem !important; }
        .mb-4 { margin-bottom: 1rem !important; }
        .mb-2 { margin-bottom: 0.5rem !important; }
        
        /* Borders */
        .rounded-lg { border-radius: 0.5rem !important; }
        .rounded-xl { border-radius: 0.75rem !important; }
        
        /* Shadow */
        .shadow-lg { box-shadow: 0 10px 15px -3px rgba(0, 0, 0, 0.1) !important; }
        
        /* Position */
        .relative { position: relative !important; }
        .absolute { position: absolute !important; }
        .top-3 { top: 0.75rem !important; }
        .right-3 { right: 0.75rem !important; }
    </style>
</head>
<body class="bg-green-50 min-h-screen flex flex-col">
    <!-- Navigation verte -->
    <nav class="nav-green">
        <div class="container mx-auto px-4">
            <div class="flex justify-between items-center py-4">
                <!-- Logo -->
  <a href="{{ route('dashboard') }}" class="flex items-center text-2xl font-bold text-white">
    <img src="{{ asset('images/logobnaapp.jpeg') }}" alt="Logo BNA" 
         class="h-16 w-24 md:h-20 md:w-32 lg:h-16 lg:w-30 mr-2 md:mr-3">
    Banque Nationale Agricole
</a>

                <!-- Menu mobile -->
                <button class="md:hidden text-white focus:outline-none" id="mobile-menu-button">
                    <i class="fas fa-bars text-xl"></i>
                </button>

                <!-- Menu desktop -->
                <div class="hidden md:flex items-center space-x-4">
                    <ul class="flex space-x-4">
                        @auth
                            <li>
                                <a class="nav-link" href="{{ route('dashboard') }}">
                                    <i class="fas fa-tachometer-alt mr-1"></i>Tableau de bord
                                </a>
                            </li>
                            @if(auth()->user()->agriculteur)
                                <li>
                                    <a class="nav-link" href="{{ route('loan-requests.index') }}">
                                        <i class="fas fa-hand-holding-usd mr-1"></i>Demandes de prêt
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-link" href="{{ route('complaints.index') }}">
                                        <i class="fas fa-comments mr-1"></i>Réclamations
                                    </a>
                                </li>
                            @endif
                            @if(auth()->user()->agentBNA)
                                <li>
                                    <a class="nav-link" href="{{ route('loan-requests.index') }}">
                                        <i class="fas fa-cog mr-1"></i>Gestion des prêts
                                    </a>
                                </li>
                                <li>
                                    <a class="nav-link" href="{{ route('complaints.index') }}">
                                        <i class="fas fa-tasks mr-1"></i>Gestion des réclamations
                                    </a>
                                </li>
                            @endif
                        @endauth
                    </ul>
                </div>

                <!-- Menu utilisateur -->
                <div class="hidden md:flex items-center space-x-4">
                    @auth
                        <span class="text-green-200 font-medium">
                            <i class="fas fa-user mr-1"></i>Bienvenue, {{ auth()->user()->prenom }}
                        </span>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="text-green-200 hover:text-white transition duration-200">
                                <i class="fas fa-sign-out-alt mr-1"></i>Déconnexion
                            </button>
                        </form>
                    @else
                        <a class="nav-link" href="{{ route('login') }}">
                            <i class="fas fa-sign-in-alt mr-1"></i>Connexion
                        </a>
                        <a class="nav-link" href="{{ route('register') }}">
                            <i class="fas fa-user-plus mr-1"></i>Inscription
                        </a>
                    @endauth
                </div>
            </div>
        </div>
    </nav>

    <!-- Menu mobile (caché par défaut) -->
    <div class="md:hidden bg-green-800 hidden" id="mobile-menu">
        <div class="container mx-auto px-4 py-4">
            <ul class="space-y-2">
                @auth
                    <li><a class="mobile-nav-link" href="{{ route('dashboard') }}">Tableau de bord</a></li>
                    @if(auth()->user()->agriculteur)
                        <li><a class="mobile-nav-link" href="{{ route('loan-requests.index') }}">Demandes de prêt</a></li>
                        <li><a class="mobile-nav-link" href="{{ route('complaints.index') }}">Réclamations</a></li>
                    @endif
                    @if(auth()->user()->agentBNA)
                        <li><a class="mobile-nav-link" href="{{ route('loan-requests.index') }}">Gestion des prêts</a></li>
                        <li><a class="mobile-nav-link" href="{{ route('complaints.index') }}">Gestion des réclamations</a></li>
                    @endif
                @endauth
            </ul>
            <div class="border-t border-green-600 mt-4 pt-4">
                @auth
                    <div class="text-green-200 mb-2">Bienvenue, {{ auth()->user()->prenom }}</div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit" class="mobile-nav-link w-full text-left">Déconnexion</button>
                    </form>
                @else
                    <a class="mobile-nav-link block" href="{{ route('login') }}">Connexion</a>
                    <a class="mobile-nav-link block" href="{{ route('register') }}">Inscription</a>
                @endauth
            </div>
        </div>
    </div>

    <!-- Contenu principal -->
    <main class="container mx-auto px-4 py-8 flex-1">
        <!-- Messages flash -->
        @if(session('success'))
            <div class="bg-green-100 border border-green-400 text-green-700 px-4 py-3 rounded-lg mb-6 relative">
                <div class="flex items-center">
                    <i class="fas fa-check-circle text-green-500 mr-2"></i>
                    <span>{{ session('success') }}</span>
                </div>
                <button class="absolute top-3 right-3 text-green-500 hover:text-green-700" onclick="this.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        @if(session('error'))
            <div class="bg-red-100 border border-red-400 text-red-700 px-4 py-3 rounded-lg mb-6 relative">
                <div class="flex items-center">
                    <i class="fas fa-exclamation-circle text-red-500 mr-2"></i>
                    <span>{{ session('error') }}</span>
                </div>
                <button class="absolute top-3 right-3 text-red-500 hover:text-red-700" onclick="this.parentElement.remove()">
                    <i class="fas fa-times"></i>
                </button>
            </div>
        @endif

        <!-- Contenu de la page -->
        @yield('content')
    </main>
<!-- Pied de page -->
<footer class="nav-green py-6 mt-8">
    <div class="container mx-auto px-4">
        <div class="text-center">
            <!-- Logo en haut du footer -->
            <div class="flex justify-center mb-4">
                <img src="{{ asset('images/logobnaapp.jpeg') }}" alt="Logo BNA" 
                     class="h-12 w-18 md:h-16 md:w-24">
            </div>
            
          
            
            <p class="text-gray-700">Copyright &copy;  Banque Nationale Agricole - 2025 - Tous droits réservés </p>
            <p class="text-gray-600 text-sm mt-2">Votre partenaire pour l'agriculture durable</p>
        </div>
    </div>
</footer>
    <!-- Scripts -->
    <script>
        // Menu mobile
        document.getElementById('mobile-menu-button').addEventListener('click', function() {
            const menu = document.getElementById('mobile-menu');
            menu.classList.toggle('hidden');
        });

        // Fermer le menu mobile en cliquant à l'extérieur
        document.addEventListener('click', function(event) {
            const menu = document.getElementById('mobile-menu');
            const button = document.getElementById('mobile-menu-button');
            
            if (!menu.contains(event.target) && !button.contains(event.target)) {
                menu.classList.add('hidden');
            }
        });
        
        // Fermer automatiquement les messages flash après 5 secondes
        setTimeout(() => {
            document.querySelectorAll('[class*="bg-"]').forEach(alert => {
                if (alert.classList.contains('bg-green-100') || alert.classList.contains('bg-red-100')) {
                    alert.style.opacity = '0';
                    setTimeout(() => alert.remove(), 300);
                }
            });
        }, 5000);
    </script>

    @stack('scripts')
</body>
</html>