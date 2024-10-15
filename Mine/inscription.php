<?php
session_start();
include 'db.php'; // Inclut le fichier de connexion à la base de données

$message = ''; // Message d'inscription

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['sinscrire'])) { // Inscription
    $nom = $_POST['nom'];
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];
    $mot_de_passe_repeté = $_POST['mot_de_passe_repeté'];

    // Vérification des mots de passe
    if ($mot_de_passe !== $mot_de_passe_repeté) {
        $message = "Les mots de passe ne correspondent pas.";
    } else {
        $mot_de_passe_hashé = password_hash($mot_de_passe, PASSWORD_BCRYPT);

        // Insertion dans la base de données
        $sql = "INSERT INTO utilisateurs (nom, email, mot_de_passe) VALUES (?, ?, ?)";
        $stmt = $pdo->prepare($sql);
        if ($stmt->execute([$nom, $email, $mot_de_passe_hashé])) {
            $message = "Inscription réussie ! Vous pouvez maintenant accéder à la page d'accueil.";
            // Redirection vers la page d'accueil après l'inscription réussie
            header("Location: acceuil.php");
            exit();
        } else {
            $message = "Erreur lors de l'inscription.";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Inscription</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header class="text-center">
        <img src="assets/img/logo.PNG" alt="Logo" style="max-width: 100px;">
        <h3>Institut de formation et de recherche en Informatique</h3>
    </header>

    <div class="container mt-5">
        <h2>Inscription</h2>

        <?php if ($message): ?>
            <div class="alert alert-info"><?php echo $message; ?></div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="mb-3">
                <label for="nom" class="form-label">Nom Complet</label>
                <input type="text" class="form-control" name="nom" required>
            </div>

            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" required>
            </div>

            <div class="mb-3">
                <label for="mot_de_passe" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" name="mot_de_passe" required>
            </div>

            <div class="mb-3">
                <label for="mot_de_passe_repeté" class="form-label">Répéter le mot de passe</label>
                <input type="password" class="form-control" name="mot_de_passe_repeté" required>
            </div>

            <button type="submit" class="btn btn-primary" name="sinscrire">S'inscrire</button>
        </form>

        <a href="connexion.php" class="btn btn-secondary mt-3">Déjà inscrit ? Connectez-vous</a>
    </div>

    <footer class="text-center">
        <p class="mb-0">&copy; 2024 IFRI. Tous droits réservés.</p>
    </footer>
</body>
</html>
