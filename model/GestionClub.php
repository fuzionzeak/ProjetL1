<?php

namespace Model;

use PDO;

class GestionClub {

    private PDO $cnx;

    // Constructeur qui prend la connexion PDO
    public function __construct(PDO $cnx) {
        $this->cnx = $cnx;
    }

    // Méthode pour récupérer tous les clubs de Ligue 1
    public function getAllClubs(): array {
        $sql = "SELECT NOM_CLUB, LIGUE_CLUB FROM CLUB WHERE LIGUE_CLUB = 'L1'";
        $stmt = $this->cnx->prepare($sql);
        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }
}
?>
