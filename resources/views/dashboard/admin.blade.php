<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard Administrateur</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>

        :root {
            --primary: #5EA87F;
            --primary-dark: #4a8666;
            --primary-light: #7dbe99;
            --success: #5EA87F;
            --info: #4e73df;
            --warning: #f6c23e;
            --danger: #e74a3b;
            --secondary: #858796;
            --light: #f8f9fc;
            --dark: #2e4a40;
            --bna-light: #edf7f1;

            /* Nouvelles couleurs pour les cartes */
            --card-agriculteurs: #f4a810ff;
            --card-agents: #C5C936;
            --card-agences: #A6CAE3;
            --card-prets: #C9C9F2;
        }

        body {
            background-color: #f8f9fc;
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            padding-bottom: 2rem;
        }

        .dashboard-header {
            background: linear-gradient(135deg, var(--primary) 0%, var(--primary-dark) 100%);
            color: white;
            border-radius: 15px;
            padding: 25px;
            margin: 20px 0 30px 0;
            box-shadow: 0 5px 25px rgba(94, 168, 127, 0.2);
        }

        .stat-card {
            border-radius: 12px;
            border: none;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            transition: all 0.3s ease;
            overflow: hidden;
            height: 100%;
            position: relative;
            background: white;
        }

        .stat-card::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(135deg, rgba(255,255,255,0.1) 0%, rgba(255,255,255,0.05) 100%);
            opacity: 0;
            transition: opacity 0.3s ease;
        }

        .stat-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 0.5rem 2.5rem 0 rgba(0, 0, 0, 0.15);
        }

        .stat-card:hover::before {
            opacity: 1;
        }

        .stat-card .card-body {
            padding: 1.75rem;
            position: relative;
            z-index: 1;
        }

        .card-agriculteurs {
            background-color: var(--card-agriculteurs);
            color: white;
        }

        .card-agents {
            background-color: var(--card-agents);
            color: #333;
        }

        .card-agences {
            background-color: var(--card-agences);
            color: #333;
        }

        .card-prets {
            background-color: var(--card-prets);
            color: #333;
        }

        .stat-icon {
            font-size: 2.2rem;
            opacity: 0.9;
        }

        .card-agriculteurs .stat-icon {
            color: rgba(255, 255, 255, 0.8) !important;
        }

        .card-agents .stat-icon {
            color: rgba(0, 0, 0, 0.7) !important;
        }

        .card-agences .stat-icon {
            color: rgba(0, 0, 0, 0.7) !important;
        }

        .card-prets .stat-icon {
            color: rgba(0, 0, 0, 0.7) !important;
        }

        .quick-actions .btn {
            border-radius: 10px;
            padding: 14px 16px;
            transition: all 0.3s;
            font-weight: 600;
            border: 2px solid transparent;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .quick-actions .btn:hover {
            transform: translateY(-3px);
            box-shadow: 0 6px 12px rgba(94, 168, 127, 0.2);
        }

        .card {
            border-radius: 12px;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            margin-bottom: 1.8rem;
            border: none;
            transition: transform 0.3s;
        }

        .card:hover {
            transform: translateY(-3px);
        }

        .card-header {
            border-top-left-radius: 12px !important;
            border-top-right-radius: 12px !important;
            padding: 1.2rem 1.8rem;
            font-weight: 700;
            background: linear-gradient(90deg, var(--bna-light) 0%, white 100%);
            border-bottom: 1px solid #e3e6f0;
            color: var(--dark);
        }

        .alert {
            border-radius: 10px;
            border: none;
            box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.1);
            padding: 1.2rem 1.5rem;
            display: flex;
            align-items: center;
            gap: 12px;
        }

        .text-xs {
            font-size: 0.9rem;
        }

        .text-gray-800 {
            color: var(--dark) !important;
        }

        h1, h2, h3, h4, h5, h6 {
            font-weight: 700;
            color: var(--dark);
        }

        .user-info {
            background: rgba(255, 255, 255, 0.2);
            padding: 12px 18px;
            border-radius: 10px;
            backdrop-filter: blur(8px);
            border: 1px solid rgba(255, 255, 255, 0.2);
        }

        .stat-value {
            font-size: 1.8rem;
            font-weight: 700;
            margin: 8px 0;
        }

        .card-agriculteurs .stat-value {
            color: white;
        }

        .stat-label {
            font-size: 0.9rem;
            text-transform: uppercase;
            letter-spacing: 1px;
            font-weight: 700;
        }

        .card-agriculteurs .stat-label {
            color: rgba(255, 255, 255, 0.9);
        }

        .card-agents .stat-label,
        .card-agences .stat-label,
        .card-prets .stat-label {
            color: rgba(0, 0, 0, 0.7);
        }

        .btn-stat {
            border-radius: 8px;
            padding: 8px 16px;
            font-weight: 600;
            margin-top: 12px;
            display: inline-flex;
            align-items: center;
            gap: 6px;
            transition: all 0.3s;
        }

        .card-agriculteurs .btn-stat {
            background-color: rgba(255, 255, 255, 0.2);
            border: 1px solid rgba(255, 255, 255, 0.3);
            color: white;
        }

        .card-agriculteurs .btn-stat:hover {
            background-color: rgba(255, 255, 255, 0.3);
            color: white;
        }

        .card-agents .btn-stat {
            background-color: rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(0, 0, 0, 0.2);
            color: #333;
        }

        .card-agents .btn-stat:hover {
            background-color: rgba(0, 0, 0, 0.2);
            color: #333;
        }

        .card-agences .btn-stat {
            background-color: rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(0, 0, 0, 0.2);
            color: #333;
        }

        .card-agences .btn-stat:hover {
            background-color: rgba(0, 0, 0, 0.2);
            color: #333;
        }

        .card-prets .btn-stat {
            background-color: rgba(0, 0, 0, 0.1);
            border: 1px solid rgba(0, 0, 0, 0.2);
            color: #333;
        }

        .card-prets .btn-stat:hover {
            background-color: rgba(0, 0, 0, 0.2);
            color: #333;
        }

        .btn-outline-primary {
            color: var(--primary);
            border-color: var(--primary);
        }

        .btn-outline-primary:hover {
            background-color: var(--primary);
            border-color: var(--primary);
            color: white;
        }

        .btn-outline-success {
            color: var(--success);
            border-color: var(--success);
        }

        .btn-outline-success:hover {
            background-color: var(--success);
            border-color: var(--success);
            color: white;
        }

        .btn-outline-warning {
            color: var(--warning);
            border-color: var(--warning);
        }

        .btn-outline-warning:hover {
            background-color: var(--warning);
            border-color: var(--warning);
            color: white;
        }

        .btn-outline-info {
            color: var(--info);
            border-color: var(--info);
        }

        .btn-outline-info:hover {
            background-color: var(--info);
            border-color: var(--info);
            color: white;
        }

        @media (max-width: 768px) {
            .dashboard-header {
                text-align: center;
            }

            .user-info {
                margin-top: 20px;
                text-align: center;
            }

            .stat-card .card-body {
                padding: 1.2rem;
            }
        }

        .bna-nav {
            background: linear-gradient(90deg, var(--primary) 0%, var(--primary-dark) 100%);
            padding: 0;
            border-radius: 0 0 15px 15px;
            margin-bottom: 30px;
            box-shadow: 0 4px 20px rgba(94, 168, 127, 0.3);
        }

        .bna-nav .container-fluid {
            padding: 0 15px;
        }

        .bna-nav .navbar-brand {
            padding: 0.5rem 0;
            margin-right: 2rem;
        }

        .logo-container {
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .logo-img {
            height: 40px;
            width: auto;
            border-radius: 5px;
        }

        .bna-nav .nav-link {
            color: rgba(255, 255, 255, 0.85);
            font-weight: 500;
            padding: 1rem 1.5rem;
            transition: all 0.3s;
            white-space: nowrap;
        }

        .bna-nav .nav-link:hover {
            color: white;
            background-color: rgba(255, 255, 255, 0.1);
        }

        .bna-nav .nav-link.active {
            color: white;
            background-color: rgba(255, 255, 255, 0.2);
            font-weight: 600;
        }

        .navbar-nav {
            align-items: center;
        }

        /* Responsive adjustments */
        @media (max-width: 991.98px) {
            .bna-nav .nav-link {
                padding: 0.75rem 1rem;
            }

            .navbar-collapse {
                border-radius: 0 0 15px 15px;
                background: linear-gradient(90deg, var(--primary) 0%, var(--primary-dark) 100%);
                padding: 10px;
            }
        }

        .content-container {
            max-width: 1400px;
            margin: 0 auto;
            padding: 0 15px;
        }

        .bg-primary {
            background-color: var(--primary) !important;
        }

        .bg-info {
            background-color: var(--info) !important;
        }

        .bg-light {
            background-color: var(--bna-light) !important;
        }

        .text-primary {
            color: var(--primary) !important;
        }

        .alert-warning {
            background-color: #fff3cd;
            color: #856404;
        }

        .alert-success {
            background-color: #d4edda;
            color: #155724;
        }

        .alert-info {
            background-color: #d1ecf1;
            color: #0c5460;
        }

        /* Animation BNA */
        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .stat-card {
            animation: fadeInUp 0.6s ease forwards;
        }

        .stat-card:nth-child(1) { animation-delay: 10s; }
        .stat-card:nth-child(2) { animation-delay: 10s; }
        .stat-card:nth-child(3) { animation-delay: 10s; }
        .stat-card:nth-child(4) { animation-delay: 10s; }



.logo-text {
    display: flex;
    flex-direction: column;
    line-height: 1.2;
}

.logo-text .title {
    font-weight: 700;
    font-size: 1.2rem;
    color: white;
}

.logo-text .subtitle {
    font-size: 0.75rem;
    font-weight: 500;
    opacity: 0.9;
    color: rgba(255, 255, 255, 0.9);
}

/* Correction pour les écrans mobiles */
@media (max-width: 768px) {
    .logo-text .title {
        font-size: 1rem;
    }

    .logo-text .subtitle {
        font-size: 0.65rem;
    }

    .logo-img {
        height: 40px;
        margin-right: 8px;
    }
}
    </style>
</head>
<body>
    <!-- Navigation -->
    <nav class="navbar bna-nav navbar-expand-lg navbar-dark">
        <div class="container-fluid">
             <a class="navbar-brand" href="#">
                <div class="logo-container">
                          <!-- OPTION 1: Logo avec image réelle -->
                    <img src="{{ asset('images/logobnaapp.jpeg') }}" alt="Logo BNA" class="logo-img">
                    <div>
                    <div>
                        <div>BNA</div>
                        <div style="font-size: 0.85rem; font-weight: 500;">Banque Nationale Agricole</div>
                    </div>
                </div>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav ms-auto">

                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.agriculteurs.pending') }}"><i class="fas fa-users me-1"></i> Agriculteurs</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.agents.index') }}"><i class="fas fa-user-tie me-1"></i> Agents</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('admin.agences.index') }}"><i class="fas fa-building me-1"></i> Agences</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-file-invoice-dollar me-1"></i> Prêts</a>
                    </li>


                    <li class="nav-item">
                        <a class="nav-link" href="#"><i class="fas fa-sign-out-alt me-1"></i> Déconnexion</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="content-container">


        <!-- Cartes de statistiques -->
        <div class="row mb-4">
            <div class="col-xl-3 col-md-6 mb-4">
                <div class="stat-card card card-agriculteurs h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="stat-label">Agriculteurs en Attente</div>
                                <div class="stat-value">12</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-clock fa-2x stat-icon"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('admin.agriculteurs.pending') }}" class="btn btn-stat">
                                <i class="fas fa-list me-1"></i> Voir la liste
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="stat-card card card-agents h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="stat-label">Total Agents</div>
                                <div class="stat-value">24</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-user-tie fa-2x stat-icon"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('admin.agents.index') }}" class="btn btn-stat">
                                <i class="fas fa-cog me-1"></i> Gérer les agents
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="stat-card card card-agences h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="stat-label">Total Agences</div>
                                <div class="stat-value">8</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-building fa-2x stat-icon"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="{{ route('admin.agences.index') }}" class="btn btn-stat">
                                <i class="fas fa-cog me-1"></i> Gérer les agences
                            </a>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-3 col-md-6 mb-4">
                <div class="stat-card card card-prets h-100">
                    <div class="card-body">
                        <div class="row align-items-center">
                            <div class="col">
                                <div class="stat-label">Demandes de Prêt</div>
                                <div class="stat-value">16</div>
                            </div>
                            <div class="col-auto">
                                <i class="fas fa-file-invoice-dollar fa-2x stat-icon"></i>
                            </div>
                        </div>
                        <div class="mt-3">
                            <a href="#" class="btn btn-stat">
                                <i class="fas fa-eye me-1"></i> Voir les demandes
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Actions Rapides et Activité Récente -->
        <div class="row">
            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header bg-primary text-white d-flex align-items-center">
                        <i class="fas fa-bolt me-2"></i>
                        <h6 class="mb-0">Actions Rapides</h6>
                    </div>
                    <div class="card-body quick-actions">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <a href="{{ route('admin.agents.create') }}" class="btn btn-outline-primary w-100">
                                    <i class="fas fa-plus"></i> Nouvel Agent
                                </a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="{{ route('admin.agences.create') }}" class="btn btn-outline-success w-100">
                                    <i class="fas fa-plus"></i> Nouvelle Agence
                                </a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="{{ route('admin.agriculteurs.pending') }}" class="btn btn-outline-warning w-100">
                                    <i class="fas fa-check-circle"></i> Valider Inscriptions
                                </a>
                            </div>
                            <div class="col-md-6 mb-3">
                                <a href="#" class="btn btn-outline-info w-100">
                                    <i class="fas fa-chart-bar"></i> Statistiques
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-lg-6">
                <div class="card mb-4">
                    <div class="card-header bg-info text-white d-flex align-items-center">
                        <i class="fas fa-chart-line me-2"></i>
                        <h6 class="mb-0">Activité Récente</h6>
                    </div>
                    <div class="card-body">
                        <div class="text-center py-4">
                            <i class="fas fa-chart-pie fa-3x text-muted mb-3"></i>
                            <p class="text-muted">Module de statistiques à venir</p>
                            <small class="text-muted">Graphiques et analytics en développement</small>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <!-- Notifications -->
        <div class="row">
            <div class="col-12">
                <div class="card">
                    <div class="card-header bg-light d-flex align-items-center">
                        <i class="fas fa-bell me-2"></i>
                        <h6 class="mb-0">Notifications Récentes</h6>
                    </div>
                    <div class="card-body">
                        <div class="alert alert-warning">
                            <i class="fas fa-exclamation-triangle fa-lg"></i>
                            <div>
                                <strong>12 inscription(s)</strong> en attente de validation
                            </div>
                        </div>

                        <div class="alert alert-success">
                            <i class="fas fa-check-circle fa-lg"></i>
                            <div>
                                Aucune inscription en attente de validation
                            </div>
                        </div>

                        <div class="alert alert-info">
                            <i class="fas fa-info-circle fa-lg"></i>
                            <div>
                                Bienvenue dans le panel d'administration BNA
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
