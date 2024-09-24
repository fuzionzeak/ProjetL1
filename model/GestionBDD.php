<?php

namespace Model;

use PDO;
use PDOException;

class GestionBDD {

    private string $user;
    private string $pass;
    private string $dsn;
    private PDO $cnx;

    // Constructeur pour initialiser les informations de connexion
    public function __construct(string $db, string $user = 'root', string $pass = '') {
        $this->user = $user;
        $this->pass = $pass;
        $this->dsn = 'mysql:host=localhost;dbname=' . $db . ';charset=utf8';
    }

    // Méthode pour se connecter à la base de données
    public function connect(): PDO {
        try {
            $this->cnx = new PDO($this->dsn, $this->user, $this->pass);
            $this->cnx->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            return $this->cnx;
        } catch (PDOException $e) {
            die("Erreur de connexion à la base de données : " . $e->getMessage());
        }
    }
}
?>
