<?php
session_start(); // Démarrer la session

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['utilisateur_id'])) {
    // Si l'utilisateur n'est pas connecté, rediriger vers la page de connexion
    header('Location: index.php'); // Remplace 'auth.php' par la page de connexion
    exit();
}

// Déconnexion
if (isset($_POST['deconnexion'])) {
    session_destroy(); // Détruire la session
    header('Location: index.php'); // Rediriger vers la page de connexion
    exit();
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Accueil - Bienvenue</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet"> <!-- Lien vers Bootstrap -->
    <link rel="stylesheet" href="assets/css/style.css"> <!-- Lien vers votre fichier CSS personnalisé -->
</head>
<body>

    <!-- En-tête avec le logo et le nom de l'institut -->
    <header class="header">
        <div class="d-flex justify-content-between align-items-center">
            <img src="assets/img/logo.PNG" alt="Logo IFRI" style="max-width: 100px;"> <!-- Ajoutez ici le chemin vers votre logo -->
            <form method="POST" action="accueil.php">
                <a  href="logout.php" name="deconnexion" class="btn btn-danger">Déconnexion</a> <!-- Bouton de déconnexion -->
            </form>
        </div>
        <h3>Institut de formation et de recherche en Informatique</h3>
    </header>

    <!-- Contenu principal -->
    <div class="container mt-5">
        <h2 class="text-center">Bienvenue, <?php echo htmlspecialchars($_SESSION['utilisateur_nom']); ?> !</h2>
        <p class="text-center">Vous êtes connecté avec l'adresse e-mail : <?php echo htmlspecialchars($_SESSION['utilisateur_email']); ?></p>

        <!-- Liste des accès rapides -->
        <div class="main-content">
            <div class="custom-box col-md-6 mx-auto">
                <h2 class="text-center">Accès rapides</h2>
                <ul class="list-group">
                    <li class="list-group-item">
                        <a href="listUser.php">Liste des Utilisateurs</a>
                    </li>
                    <li class="list-group-item">
                        <a href="clubE/index.php">Adhésion à l'association d'échecs</a>
                    </li>
                    <li class="list-group-item">
                        <a href="etuINS/index.php">Inscription, compétence et langue des Etudiants</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!-- Pied de page -->
    <footer class="footer mt-5">
        <div class="container">
            <p class="text-center mb-0">&copy; 2024 IFRI. Tous droits réservés.</p>
        </div>
    </footer>

    <script src="assets/js/bootstrap.bundle.min.js"></script> <!-- Lien vers Bootstrap JS -->
</body>
</html>
