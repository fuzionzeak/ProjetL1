<?php

// Correction du chemin d'inclusion
require_once __DIR__ . '/../model/GestionBDD.php';
require_once __DIR__ . '/../model/GestionClub.php';

use Model\GestionBDD;
use Model\GestionClub;

// Connexion à la base de données
$gestionBDD = new GestionBDD('ligue1');
$cnx = $gestionBDD->connect();

// Création de l'objet GestionClub pour manipuler les clubs
$gestionClub = new GestionClub($cnx);

// Récupération des clubs
$clubs = $gestionClub->getAllClubs();

// Affichage des clubs dans un tableau HTML
echo "<h1>Clubs de Ligue 1</h1>";
echo "<table border='1' cellpadding='5'>";
echo "<tr><th>Nom du Club</th><th>Ligue</th></tr>";

foreach ($clubs as $club) {
    echo "<tr>";
    echo "<td>" . htmlspecialchars($club['NOM_CLUB']) . "</td>";
    echo "<td>" . htmlspecialchars($club['LIGUE_CLUB']) . "</td>";
    echo "</tr>";
}

echo "</table>";
?>
