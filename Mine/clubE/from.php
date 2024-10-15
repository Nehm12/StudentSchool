<?php
session_start(); // Démarrer la session

// Vérifier si l'utilisateur est connecté
if (!isset($_SESSION['utilisateur_id'])) {
    header('Location: ../index.php'); // Rediriger vers la page de connexion si non connecté
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
    $prenom = $_POST['prenom'];
    $date_naissance = $_POST['date_naissance'];
    $telephone = $_POST['telephone'];
    $adresse = $_POST['adresse'];
    $email = $_POST['email'];
    $profession = $_POST['profession'];
    $interets = implode(", ", $_POST['interet'] ?? []);
    $niveau = $_POST['niveau'];
    $motivations = $_POST['motivations'];

    // Préparer et exécuter l'insertion
    $sql = "INSERT INTO echeciers (nom, prenom, date_naissance, telephone, adresse, email, profession, interet, niveau, motivations)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $pdo->prepare($sql);
    
    // Essayer d'exécuter l'insertion
    try {
        $stmt->execute([$nom, $prenom, $date_naissance, $telephone, $adresse, $email, $profession, $interets, $niveau, $motivations]);
        $message = 'Échecier ajouté avec succès !'; // Message de succès
        header('Location: index.php'); // Rediriger vers la liste des écheciers
        exit(); // Assurez-vous d'arrêter l'exécution après la redirection
    } catch (PDOException $e) {
        $message = 'Erreur lors de l\'ajout de l\'échecier : ' . $e->getMessage(); // Message d'erreur
    }
}
?>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Formulaire d'Adhésion - Club d'Échecs</title>
    <link href="../assets/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../assets/css/style.css">
    <style>
        .form-container {
            max-height: 70vh; /* Hauteur maximale pour permettre le défilement */
            overflow-y: auto; /* Active le défilement vertical */
            margin-bottom: 20px; /* Espace pour le bouton en bas */
        }
    </style>
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
        <h2 class="text-center">Formulaire d'Adhésion - Club d'Échecs</h2>

        <?php if ($message): ?>
            <div class="alert alert-info text-center">
                <?php echo htmlspecialchars($message); ?>
            </div>
        <?php endif; ?>

        <div class="form-container">
            <form action="" method="POST" id="echecierForm">
                <div class="form-group">
                    <label for="nom">Nom :</label>
                    <input type="text" id="nom" name="nom" required class="form-control">
                </div>

                <div class="form-group">
                    <label for="prenom">Prénom :</label>
                    <input type="text" id="prenom" name="prenom" required class="form-control">
                </div>

                <div class="form-group">
                    <label for="date_naissance">Date de naissance :</label>
                    <input type="date" id="date_naissance" name="date_naissance" required class="form-control">
                </div>

                <div class="form-group">
                    <label for="telephone">Numéro de téléphone :</label>
                    <input type="tel" id="telephone" name="telephone" pattern="[0-9]{10}" required class="form-control">
                </div>

                <div class="form-group">
                    <label for="adresse">Adresse :</label>
                    <textarea id="adresse" name="adresse" rows="3" required class="form-control"></textarea>
                </div>

                <div class="form-group">
                    <label for="email">Adresse e-mail :</label>
                    <input type="email" id="email" name="email" required class="form-control">
                </div>

                <div class="form-group">
                    <label for="profession">Profession :</label>
                    <select id="profession" name="profession" required class="form-control">
                        <option value="Etudiant">Étudiant</option>
                        <option value="Salarie">Salarié</option>
                        <option value="Independant">Indépendant</option>
                    </select>
                </div>

                <div class="form-group">
                    <label>Centres d'intérêt :</label>
                    <div>
                        <input type="checkbox" name="interet[]" value="Sport"> Sport
                        <input type="checkbox" name="interet[]" value="Musique"> Musique
                        <input type="checkbox" name="interet[]" value="Lecture"> Lecture
                        <input type="checkbox" name="interet[]" value="Voyages"> Voyages
                    </div>
                </div>

                <div class="form-group">
                    <label for="niveau">Niveau de jeu :</label>
                    <select id="niveau" name="niveau" required class="form-control">
                        <option value="Debutant">Débutant</option>
                        <option value="Intermediaire">Intermédiaire</option>
                        <option value="Avance">Avancé</option>
                    </select>
                </div>

                <div class="form-group">
                    <label for="motivations">Motivations :</label>
                    <textarea id="motivations" name="motivations" rows="4" required class="form-control"></textarea>
                </div>

                <!-- Bouton de soumission -->
                <div class="text-center">
                    <button type="submit" class="btn btn-primary">Ajouter Échecier</button>
                </div>
            </form>
        </div>
    </div>

    <footer class="footer mt-5">
        <div class="container">
            <p class="text-center mb-0">&copy; 2024 IFRI. Tous droits réservés.</p>
        </div>
    </footer>

    <script src="../assets/js/bootstrap.bundle.min.js"></script>
</body>
</html>
