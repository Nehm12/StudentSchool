<?php
session_start(); // Démarrer la session

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['utilisateur_id'])) {
    header('Location: index.php'); // Rediriger vers la page de connexion si non connecté
    exit();
}

// Inclure le fichier de connexion à la base de données
include '../db.php';

// Initialiser une variable pour le message de succès ou d'erreur
$message = '';

// Vérifier si le formulaire a été soumis
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupérer les données du formulaire
    $nom = $_POST['nom'];
    $langues_parlees = $_POST['langues_parlees'];
    $competences_programmation = $_POST['competences_programmation'];

    // Préparer et exécuter l'insertion
    $sql = "INSERT INTO etudiants (nom, langues_parlees, competences_programmation)
            VALUES (?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    
    // Essayer d'exécuter l'insertion
    try {
        $stmt->execute([$nom, $langues_parlees, $competences_programmation]);
        $message = 'Étudiant ajouté avec succès !'; // Message de succès
        header('Location: index.php'); // Rediriger vers la liste des étudiants
        exit(); // Assurez-vous d'arrêter l'exécution après la redirection
    } catch (PDOException $e) {
        $message = 'Erreur lors de l\'ajout de l\'étudiant : ' . $e->getMessage(); // Message d'erreur
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'Ajout d'Étudiant</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
</head>
<body>

    <header class="header text-center">
        <img src="../assets/img/logo.PNG" alt="Logo IFRI" style="max-width: 100px;">
        <h3>Institut de formation et de recherche en Informatique</h3>
        <div class="text-end mt-3">
            <a href="../deconnexion.php" class="btn btn-danger">Déconnexion</a>
        </div>
    </header>

    <div class="container mt-5">
        <h2 class="text-center">Ajouter un Étudiant</h2>

        <?php if ($message): ?>
            <div class="alert alert-info text-center">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="form-group">
                <label for="nom">Nom :</label>
                <input type="text" id="nom" name="nom" required class="form-control">
            </div>

            <div class="form-group">
                <label for="langues_parlees">Langues Parlées :</label>
                <input type="text" id="langues_parlees" name="langues_parlees" required class="form-control">
            </div>

            <div class="form-group">
                <label for="competences_programmation">Compétences en Programmation :</label>
                <input type="text" id="competences_programmation" name="competences_programmation" required class="form-control">
            </div>

            <div class="text-center">
                <button type="submit" class="btn btn-primary">Ajouter Étudiant</button>
            </div>
        </form>
    </div>

    <footer class="footer mt-5">
        <div class="container">
            <p class="text-center mb-0">&copy; 2024 IFRI. Tous droits réservés.</p>
        </div>
    </footer>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
