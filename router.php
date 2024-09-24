<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPClass.php to edit this template
 */

/**
 * Description of Router
 *
 * @author 
 */

class Router {
    private array $routes;

    public function __construct() {
        $this->routes=[]; // creation d'un tableau vide
    }

    // Ajoute une route au routeur
    public function addRoute($url, $controllerFile) {
        $this->routes[$url] = $controllerFile;
    }

    // Traite la demande actuelle
    public function execute($url) {
        if (array_key_exists($url, $this->routes)) {
            // Si l'URL correspond à une route, incluez le fichier du contrôleur
            $controllerFile = $this->routes[$url];
            if (file_exists($controllerFile)) {
                include_once($controllerFile);
            } else {
                // Gérer les erreurs si le fichier du contrôleur n'existe pas
                echo "Erreur : Contrôleur non trouvé";
            }
        } else {
            // Gérer les erreurs 404 si l'URL n'est pas trouvée
            echo "Page non trouvée (Erreur 404)";
        }
    }
}


// Configuration du routeur
if (isset($_GET['page'])) {
    $page = $_GET['page'];
} else {
    $page = 'home'; // Page par défaut
}

// Charger le contrôleur en fonction de la route
switch ($page) {
    case 'page1':
        require_once 'controller/c_page1.php';
        break;
    case 'page2':
        require_once 'controller/c_page2.php';
        break;
    case 'page3':
        require_once 'controller/c_page3.php';
        break;
    default:
        echo "Page non trouvée.";
        break;
}
?>