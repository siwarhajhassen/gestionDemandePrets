<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>BNA - Accueil</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
        <div class="container">
            <a class="navbar-brand" href="/">Banque Nationale Agricole</a>
        </div>
    </nav>

    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-6 text-center">
                <h1>Bienvenue à la BNA</h1>
                <p class="lead">Système de gestion des prêts agricoles</p>
                <div class="mt-4">
                    <a href="{{ route('login') }}" class="btn btn-primary me-3">Connexion</a>
                    <a href="{{ route('register') }}" class="btn btn-outline-primary">Inscription</a>
                </div>
            </div>
        </div>
    </div>
</body>
</html>