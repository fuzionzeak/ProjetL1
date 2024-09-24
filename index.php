<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <title>Accueil</title>
</head>
<body>

<!-- Liens vers les différentes pages contrôleur -->
<nav>
    <ul>
        <li><a href="index.php?page=page1">Voir Page 1</a></li>
        <li><a href="index.php?page=page2">Voir Page 2</a></li>
        <li><a href="index.php?page=page3">Voir Page 3</a></li>
    </ul>
</nav>

<!-- Inclusion du routeur pour gérer les différentes pages -->
<?php
require_once 'router.php';
?>

</body>
</html>
