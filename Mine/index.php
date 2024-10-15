<?php
session_start();
include 'db.php'; // Inclut le fichier de connexion à la base de données

$message = ''; // Message de connexion

if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['se_connecter'])) { // Connexion
    $email = $_POST['email'];
    $mot_de_passe = $_POST['mot_de_passe'];

    // Requête pour récupérer l'utilisateur
    $sql = "SELECT * FROM utilisateurs WHERE email = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute([$email]);
    $utilisateur = $stmt->fetch();

    // Vérification du mot de passe
    if ($utilisateur && password_verify($mot_de_passe, $utilisateur['mot_de_passe'])) {
        // Connexion réussie - Démarrer une session pour l'utilisateur
        $_SESSION['utilisateur_id'] = $utilisateur['id'];
        $_SESSION['utilisateur_nom'] = $utilisateur['nom'];
        $_SESSION['utilisateur_email'] = $utilisateur['email'];

        // Redirection vers la page d'accueil après connexion
        header("Location: acceuil.php");
        exit();
    } else {
        $message = "Email ou mot de passe incorrect.";
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Connexion</title>
    <link href="assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="assets/css/style.css">
</head>
<body>
    <header class="text-center">
        <img src="assets/img/logo.PNG" alt="Logo" style="max-width: 100px;">
        <h3>Institut de formation et de recherche en Informatique</h3>
    </header>

    <div class="container mt-5">
        <h2>Connexion</h2>

        <?php if ($message): ?>
            <div class="alert alert-danger"><?php echo $message; ?></div>
        <?php endif; ?>

        <form action="" method="POST">
            <div class="mb-3">
                <label for="email" class="form-label">Email</label>
                <input type="email" class="form-control" name="email" required>
            </div>

            <div class="mb-3">
                <label for="mot_de_passe" class="form-label">Mot de passe</label>
                <input type="password" class="form-control" name="mot_de_passe" required>
            </div>

            <button type="submit" class="btn btn-primary" name="se_connecter">Se connecter</button>
        </form>

        <a href="inscription.php" class="btn btn-secondary mt-3">Pas encore inscrit ? Inscrivez-vous</a> <!-- Ajout du bouton pour s'inscrire -->
    </div>

    <footer class="text-center">
        <p class="mb-0">&copy; 2024 IFRI. Tous droits réservés.</p>
    </footer>
</body>
</html>
