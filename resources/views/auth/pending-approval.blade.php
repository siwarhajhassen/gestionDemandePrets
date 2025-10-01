<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>En Attente de Validation - Plateforme Prêts Agricoles BNA</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        :root {
            --bna-green: #56A875;
            --bna-dark-green: #3d8a5c;
            --bna-light-green: #e9f4ec;
            --bna-gold: #c6a568;
            --bna-orange: #ff9742;
        }
        
        body {
            background-color: #f5f9f6;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            background-image: url("data:image/svg+xml,%3Csvg width='100' height='100' viewBox='0 0 100 100' xmlns='http://www.w3.org/2000/svg'%3E%3Cpath d='M11 18c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm48 25c3.866 0 7-3.134 7-7s-3.134-7-7-7-7 3.134-7 7 3.134 7 7 7zm-43-7c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm63 31c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM34 90c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zm56-76c1.657 0 3-1.343 3-3s-1.343-3-3-3-3 1.343-3 3 1.343 3 3 3zM12 86c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm28-65c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm23-11c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-6 60c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm29 22c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zM32 63c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm57-13c2.76 0 5-2.24 5-5s-2.24-5-5-5-5 2.24-5 5 2.24 5 5 5zm-9-21c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM60 91c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM35 41c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2zM12 60c1.105 0 2-.895 2-2s-.895-2-2-2-2 .895-2 2 .895 2 2 2z' fill='%2356A875' fill-opacity='0.05' fill-rule='evenodd'/%3E%3C/svg%3E");
        }
        .bna-card {
            border-radius: 12px;
            box-shadow: 0 5px 25px rgba(86, 168, 117, 0.15);
            border: none;
            margin-top: 2rem;
            overflow: hidden;
        }
        .bna-header {
            background: linear-gradient(135deg, var(--bna-green) 0%, var(--bna-dark-green) 100%);
            color: white;
            padding: 2rem;
            text-align: center;
        }
       .bna-logo {
            width: 100px;
            margin-bottom: 15px;
        }
        .status-icon {
            font-size: 5rem;
            color: #ffc107;
            margin: 1.5rem 0;
            animation: pulse 2s infinite;
        }
        @keyframes pulse {
            0% { transform: scale(1); }
            50% { transform: scale(1.05); }
            100% { transform: scale(1); }
        }
        .info-box {
            background-color: var(--bna-light-green);
            border-left: 4px solid var(--bna-green);
            border-radius: 6px;
            padding: 1.2rem;
            margin: 1.5rem 0;
        }
        .contact-info {
            background-color: #f1f8e9;
            border-radius: 8px;
            padding: 1.5rem;
            margin-top: 1.5rem;
            border: 1px solid var(--bna-light-green);
        }
        .btn-bna {
            background-color: var(--bna-green);
            color: white;
            padding: 0.6rem 2rem;
            border-radius: 6px;
            transition: all 0.3s;
            border: none;
        }
        .btn-bna:hover {
            background-color: var(--bna-dark-green);
            color: white;
            transform: translateY(-2px);
            box-shadow: 0 4px 8px rgba(86, 168, 117, 0.3);
        }
        .btn-outline-bna {
            color: var(--bna-green);
            border-color: var(--bna-green);
            padding: 0.6rem 2rem;
            border-radius: 6px;
            transition: all 0.3s;
        }
        .btn-outline-bna:hover {
            background-color: var(--bna-green);
            color: white;
            transform: translateY(-2px);
        }
        .footer {
            margin-top: 2rem;
            font-size: 0.9rem;
            color: var(--bna-dark-green);
        }
        .progress-container {
            margin: 2rem 0;
        }
        .progress {
            height: 12px;
            border-radius: 10px;
            background-color: #e0e0e0;
        }
        .progress-bar {
            background: linear-gradient(to right, #8bc34a, var(--bna-green));
            border-radius: 10px;
        }
        .countdown {
            font-size: 1.2rem;
            font-weight: bold;
            color: var(--bna-green);
            background-color: var(--bna-light-green);
            padding: 0.8rem 1.5rem;
            border-radius: 30px;
            display: inline-block;
        }
        .leaf-decoration {
            color: var(--bna-green);
            opacity: 0.7;
            font-size: 1.5rem;
            margin: 0 0.5rem;
        }
        h3.text-primary {
            color: var(--bna-green) !important;
        }
        
        /* Styles pour l'animation de texte */
        .animated-text-container {
            min-height: 120px;
            margin: 1.5rem 0;
        }
        .fade-in-text {
            opacity: 0;
            animation: fadeIn 2s ease-in forwards;
            animation-delay: 0.5s;
            color: #2e7d32;
            margin-top: 1rem;
            font-weight: 500;
            line-height: 1.6;
        }
        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(10px); }
            to { opacity: 1; transform: translateY(0); }
        }
    </style>
</head>
<body>
    <div class="container py-5">
        <div class="row justify-content-center">
            <div class="col-md-10 col-lg-8">
                <div class="card bna-card">
                    <div class="card-header bna-header text-center">    
                        <img src="{{ asset('images/logobnaapp.jpeg') }}" alt="Logo BNA" class="bna-logo">
                        <h3 class="mb-0 mt-2">Espace Agriculteur</h3>
                    </div>
                    <div class="card-body text-center py-5 px-4">
                        <div class="status-icon">
                            <i class="fas fa-clock"></i>
                        </div>
                        <h3 class="text-primary mb-3">En Attente de Validation</h3>
                        
                        <div class="progress-container">
                            <div class="d-flex justify-content-between mb-2">
                                <span>Statut de votre demande</span>
                                <span>80%</span>
                            </div>
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" style="width: 80%" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                        </div>
                        
                        <div class="info-box text-start">
                            <p class="mb-0"><i class="fas fa-info-circle me-2" style="color: var(--bna-orange);"></i> Votre demande de prêt agricole a été reçue et est en cours de traitement par nos services.</p>
                        </div>
                        
                        <div class="animated-text-container">
                           <div class="fade-in-text">
                                Nous avons bien reçu votre dossier et celui-ci est actuellement en cours d'analyse par notre équipe.
                                <br>
                                Vous serez informé par SMS dès que votre compte sera activé.
                            </div>
                        </div>
                        
                        <div class="contact-info text-start">
                            <h5 class="mb-3" style="color: var(--bna-green);"><i class="fas fa-phone-alt me-2"></i> Contactez-nous</h5>
                            <p class="mb-2">Si vous avez des questions, n'hésitez pas à nous contacter :</p>
                            <p class="mb-1"><strong><i class="fas fa-phone me-2"></i>Appelez-nous au :</strong><br>(+216) 70554900 <br>(+216) 80100505 </p>
                            <p class="mb-0"><strong><i class="fas fa-envelope me-2"></i>Email:</strong> contact@bna.tn</p>
                        </div>
                        
                        <div class="my-4">
                            <div class="countdown">
                                <i class="fas fa-hourglass-half me-2"></i> Temps estimé de traitement: 24-48 heures
                            </div>
                        </div>
                        
                        <div class="d-flex justify-content-center mt-4 flex-wrap">
                            <a href="http://www.bna.tn" class="btn btn-outline-bna me-3 mb-2">
                                <i class="fas fa-globe me-2"></i> Site Web BNA
                            </a>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <button type="submit" class="btn btn-bna mb-2">
                                    <i class="fas fa-sign-out-alt me-2"></i> Se déconnecter
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
                
                <div class="footer text-center mt-4">
                    <p class="mb-1">© 2025 Banque Nationale Agricole - Tous droits réservés</p>
                    <div>
                        <i class="leaf-decoration fas fa-leaf"></i>
                        <i class="leaf-decoration fas fa-seedling"></i>
                        <i class="leaf-decoration fas fa-tractor"></i>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap JS Bundle -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    
    <script>
        // Fonction pour réinitialiser et rejouer l'animation
        function replayAnimation() {
            const fadeIn = document.querySelector('.fade-in-text');
            
            // Réinitialiser l'animation
            fadeIn.style.animation = 'none';
            
            // Forcer le recalcul des styles pour redémarrer l'animation
            void fadeIn.offsetWidth;
            
            // Réappliquer l'animation
            fadeIn.style.animation = 'fadeIn 2s ease-in forwards';
            fadeIn.style.animationDelay = '0.5s';
        }
        
        // Rejouer l'animation lorsque la page est chargée
        document.addEventListener('DOMContentLoaded', function() {
            // Rejouer l'animation après 8 secondes (une fois l'animation initiale terminée)
            setTimeout(replayAnimation, 8000);
        });
    </script>
</body>
</html>