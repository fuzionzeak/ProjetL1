<?php  ?>
<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title></title>
</head>
<body>
    <ul><li>page1</li></ul>
    <?php
// Inclure le fichier GestionBDD depuis le dossier model
require_once 'model/GestionBDD.php';

// Utiliser l'espace de noms de GestionBDD si défini
use Model\GestionBDD;

// Créer une instance de la classe GestionBDD avec les bons paramètres
$gestionBDD = new GestionBDD('ligue1', 'root', '');

// Tester la connexion
try {
    $cnx = $gestionBDD->connect();
    echo "Connexion à la base de données réussie.";
} catch (PDOException $e) {
    echo "Erreur lors de la connexion : " . $e->getMessage();
}
?>
