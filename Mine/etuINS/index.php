<?php
session_start(); // Démarrer la session

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['utilisateur_id'])) {
    header('Location: ../index.php'); // Rediriger vers la page de connexion si non connecté
    exit();
}

// Inclure le fichier de connexion à la base de données
include '../db.php';

// Récupérer la liste des étudiants
$sql = "SELECT id, nom, langues_parlees, competences_programmation FROM etudiants"; 
$stmt = $pdo->prepare($sql);
$stmt->execute();
$etudiants = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Étudiants</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

    <header class="header text-center">
        <img src="../assets/img/logo.PNG" alt="Logo IFRI" style="max-width: 100px;">
        <h3>Institut de formation et de recherche en Informatique</h3>
        <div class="text-end mt-3">
            <a href="../logout.php" class="btn btn-danger">Déconnexion</a>
        </div>
    </header>

    <div class="container mt-5">
        <h2 class="text-center">Liste des Étudiants</h2>

        <div class="d-flex justify-content-between mb-3">
            <a href="form.php" class="btn btn-primary">Ajouter un Étudiant</a> <!-- Bouton pour ajouter un étudiant -->
            <div>
                <button onclick="window.print();" class="btn btn-success">Imprimer la Liste</button> <!-- Bouton pour imprimer -->
                <a href="../acceuil.php" class="btn btn-secondary">Aller à l'Accueil</a> <!-- Bouton pour aller à l'accueil -->
            </div>
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Langues Parlées</th>
                    <th>Compétences en Programmation</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($etudiants as $etudiant): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($etudiant['id']); ?></td>
                        <td><?php echo htmlspecialchars($etudiant['nom']); ?></td>
                        <td><?php echo htmlspecialchars($etudiant['langues_parlees']); ?></td>
                        <td><?php echo htmlspecialchars($etudiant['competences_programmation']); ?></td>
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

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
