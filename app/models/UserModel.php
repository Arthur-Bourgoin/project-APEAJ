<?php

namespace App\Models;
class UserModel {
    public static function getAllUsers() {
        // Simulation de requête SQL (on récupère les données à partir de la BD)
        return [
            ['nom' => 'Bourgoin', 'prenom' => 'Arthur'],
            ['nom' => 'Bignon', 'prenom' => 'Charley'],
            ['nom' => 'Gayrard', 'prenom' => 'Mateo'],
            ['nom' => 'Renaud', 'prenom' => 'Paulin']
        ];
    }
}