<?php

require_once __DIR__ . '/../model/GestionBDD.php';
require_once __DIR__ . '/../model/GestionClub.php';

use Model\GestionBDD;
use Model\GestionClub;

// Connexion à la base de données
$gestionBDD = new GestionBDD('ligue1');
$cnx = $gestionBDD->connect();

// Création de l'objet GestionClub pour manipuler les clubs
$gestionClub = new GestionClub($cnx);

// Récupération des clubs pour les afficher en boutons
$clubs = $gestionClub->getAllClubs();

// ID_CLUB par défaut (changez la valeur par l'ID d'un club existant dans votre base)
$idClubParDefaut = 1;

// Traitement du formulaire d'inscription
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Récupération des données du formulaire
    $nom = $_POST['nom'] ?? '';
    $prenom = $_POST['prenom'] ?? '';
    $sexe = $_POST['sexe'] ?? '';
    $password = password_hash($_POST['password'] ?? '', PASSWORD_BCRYPT); // Hash du mot de passe pour la sécurité
    $clubsChoisis = $_POST['clubs'] ?? [];
    $image = $_FILES['image'] ?? null;

    // Définir ID_CLUB à partir de la sélection ou utiliser une valeur par défaut
    $idClub = !empty($clubsChoisis) ? (int)$clubsChoisis[0] : $idClubParDefaut;

    // Traitement de l'image de profil (sauvegarde dans un dossier, etc.)
    $imagePath = '';
    if ($image && $image['error'] === 0) {
        $uploadDir = __DIR__ . '/../uploads/';
        if (!is_dir($uploadDir)) {
            mkdir($uploadDir, 0777, true); // Crée le dossier s'il n'existe pas
        }
        $imagePath = $uploadDir . basename($image['name']);
        move_uploaded_file($image['tmp_name'], $imagePath);
    }

    // Insertion de l'utilisateur dans la base de données
    $stmt = $cnx->prepare("INSERT INTO UTILISATEUR (ID_CLUB, NOM_UTI, PRENOM_UTI, SEXE_UTI, PASSWORD_UTI, IMAGE_UTI, DATE_INSCRIPTION) 
                           VALUES (:id_club, :nom, :prenom, :sexe, :password, :image, NOW())");

    $stmt->bindParam(':id_club', $idClub, PDO::PARAM_INT);
    $stmt->bindParam(':nom', $nom);
    $stmt->bindParam(':prenom', $prenom);
    $stmt->bindParam(':sexe', $sexe);
    $stmt->bindParam(':password', $password);
    $stmt->bindParam(':image', $imagePath);
    $stmt->execute();

    // Récupération de l'ID de l'utilisateur inséré
    $userId = $cnx->lastInsertId();

    // Insertion des abonnements aux clubs sélectionnés
    if (!empty($clubsChoisis)) {
        $stmtAbonnement = $cnx->prepare("INSERT INTO S_ABONNER (ID_UTI, ID_CLUB) VALUES (:id_uti, :id_club)");
        foreach ($clubsChoisis as $clubId) {
            $stmtAbonnement->bindParam(':id_uti', $userId);
            $stmtAbonnement->bindParam(':id_club', $clubId, PDO::PARAM_INT);
            $stmtAbonnement->execute();
        }
    }

    echo "Inscription réussie !"; // Message de succès
}
?>






<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Inscription</title>
</head>
<body>

<h1>Formulaire d'inscription</h1>

<form action="index.php?page=page2" method="POST" enctype="multipart/form-data">
    <label for="nom">Nom :</label>
    <input type="text" id="nom" name="nom" required><br>

    <label for="prenom">Prénom :</label>
    <input type="text" id="prenom" name="prenom" required><br>

    <label for="sexe">Sexe :</label>
    <select id="sexe" name="sexe" required>
        <option value="Homme">Homme</option>
        <option value="Femme">Femme</option>
        <option value="Autre">Autre</option>
    </select><br>

    <label for="password">Mot de passe :</label>
    <input type="password" id="password" name="password" required><br>

    <label for="image">Image de profil :</label>
    <input type="file" id="image" name="image" accept="image/*" required><br>

    <h3>Clubs préférés :</h3>
    <?php foreach ($clubs as $club): ?>
        <label>
            <input type="checkbox" name="clubs[]" value="<?= htmlspecialchars($club['ID_CLUB'] ?? '', ENT_QUOTES, 'UTF-8'); ?>">
            <?= htmlspecialchars($club['NOM_CLUB'] ?? 'Nom Inconnu', ENT_QUOTES, 'UTF-8'); ?>
        </label><br>
    <?php endforeach; ?>

    <button type="submit">S'inscrire</button>
</form>

</body>
</html>
