<?php
session_start(); // Démarrer la session

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['utilisateur_id'])) {
    header('Location: index.php'); // Rediriger vers la page de connexion si non connecté
    exit();
}

// Inclure le fichier de connexion à la base de données
include 'db.php';

// Récupérer la liste des utilisateurs
$sql = "SELECT id, nom, email FROM utilisateurs"; // Adapter la requête selon votre base de données
$stmt = $pdo->prepare($sql);
$stmt->execute();
$utilisateurs = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Utilisateurs</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>

    <header class="header text-center">
        <img src="assets/img/logo.PNG" alt="Logo IFRI" style="max-width: 100px;">
        <h3>Institut de formation et de recherche en Informatique</h3>
        <div class="text-end mt-3">
            <a href="logout.php" class="btn btn-danger">Déconnexion</a>
        </div>
    </header>

    <div class="container mt-5">
        <h2 class="text-center">Liste des Utilisateurs</h2>

        <div class="d-flex justify-content-between mb-3">
            <a href="inscription.php" class="btn btn-primary">Ajouter un Utilisateur</a> <!-- Bouton pour ajouter un utilisateur -->
            <button onclick="imprimerListe()" class="btn btn-success">Imprimer la Liste</button> <!-- Bouton pour imprimer -->
            <a href="acceuil.php" class="btn btn-info">Retour à l'Accueil</a> <!-- Bouton pour revenir à l'accueil -->
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Email</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($utilisateurs as $utilisateur): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($utilisateur['id']); ?></td>
                        <td><?php echo htmlspecialchars($utilisateur['nom']); ?></td>
                        <td><?php echo htmlspecialchars($utilisateur['email']); ?></td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
    </div>

    <footer class="footer mt-5">
        <div class="container">
            <p class="text-center mb-0">&copy; 2024 IFRI. Tous droits réservés.</p>
        </div>
    </footer>

    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script>
        function imprimerListe() {
            window.print(); // Fonction pour imprimer la page
        }
    </script>
</body>
</html>
<