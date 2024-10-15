<?php
session_start(); // Démarrer la session

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['utilisateur_id'])) {
    header('Location: ../index.php'); // Rediriger vers la page de connexion si non connecté
    exit();
}

// Inclure le fichier de connexion à la base de données
include '../db.php';

// Récupérer la liste des écheciers
$sql = "SELECT id, nom, prenom, email, telephone, date_naissance, adresse FROM echeciers"; 
$stmt = $pdo->prepare($sql);
$stmt->execute();
$echeciers = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Liste des Adhésions - Club d'Échecs</title>
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
        <h2 class="text-center">Liste des Écheciers</h2>

        <!-- Boutons pour ajouter un utilisateur et imprimer la liste -->
        <div class="mb-3">
            <a href="from.php" class="btn btn-primary">Ajouter un Échecier</a>
            <button class="btn btn-secondary" onclick="window.print();">Imprimer la Liste</button>
            <a href="../acceuil.php" class="btn btn-info">Retour à l'Accueil</a> <!-- Bouton pour revenir à l'accueil -->
        </div>

        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Nom</th>
                    <th>Prénom</th>
                    <th>Email</th>
                    <th>Téléphone</th>
                    <th>Date de Naissance</th>
                    <th>Adresse</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($echeciers as $echecier): ?>
                    <tr>
                        <td><?php echo htmlspecialchars($echecier['id']); ?></td>
                        <td><?php echo htmlspecialchars($echecier['nom']); ?></td>
                        <td><?php echo htmlspecialchars($echecier['prenom']); ?></td>
                        <td><?php echo htmlspecialchars($echecier['email']); ?></td>
                        <td><?php echo htmlspecialchars($echecier['telephone']); ?></td>
                        <td><?php echo htmlspecialchars($echecier['date_naissance']); ?></td>
                        <td><?php echo htmlspecialchars($echecier['adresse']); ?></td>
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
