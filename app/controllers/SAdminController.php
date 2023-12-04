<?php

namespace App\Controllers;

class SAdminController extends AdminController {

    public function __construct() {
        parent::__construct();
        if($_SESSION["role"] !== "sadmin") {
            require("../app/views/error403.php");
            exit();
        }
    }

    public function home() {
        //$formations = UserModel::getAllFormations();
        $formations = [
            ['Id_formation' => '1','Libelle' => 'Electricité', 'Description' => 'Description','image' => '/assets/images/formation/ampoules.jpg'],
            ['Id_formation' => '2','Libelle' => 'Plomberie', 'Description' => 'Description','image' => '/assets/images/formation/ampoules.jpg'],
            ['Id_formation' => '3','Libelle' => 'Amenagement', 'Description' => 'Description','image' => '/assets/images/formation/ampoules.jpg'],
            ['Id_formation' => '4','Libelle' => 'Finition', 'Description' => 'Description','image' => '/assets/images/formation/ampoules.jpg']
        ];

        require("../app/views/sadmins/home.php");
        }

    public function addUser() {
        echo "Créer un Utilisateur";
    }

    public function rmStudent() {
        //code
    }

    public function addFormation() {
        echo "Créer une formation";
    }

    public function consultFormation(int $id) {
        $formation = ['Id' => '1','Libelle' => 'Electricité', 'Description' => 'Description','NiveauQual' => 'CAP', 'image' => '/assets/images/formation/ampoules.jpg'];

        $educators = [
            ['Id_utilisateur'=> '3','Nom'=> 'BALZAC','Prenom'=> 'Théo','TypeU'=> 'Admin Educateur', 'image'=> '/assets/images/Utilisateurs/theo.png'],
            ['Id_utilisateur'=> '2','Nom'=> 'CHARBONNIER','Prenom'=> 'Alban','TypeU'=> 'Educateur', 'image'=> '/assets/images/Utilisateurs/alban.png'],
            ['Id_utilisateur'=> '4','Nom'=> 'DELAUNAY','Prenom'=> 'Flora','TypeU'=> 'Educateur', 'image'=> '/assets/images/Utilisateurs/flora.png']
        ];
        
        $students = [
            ['Id_utilisateur'=> '6','Nom'=> 'DROZ','Prenom'=> 'Romane','TypeU'=> 'Eleve', 'image'=> '/assets/images/Utilisateurs/romane.png'],
            ['Id_utilisateur'=> '7','Nom'=> 'DU TOIT','Prenom'=> 'Bruno','TypeU'=> 'Eleve', 'image'=> '/assets/images/Utilisateurs/bruno.png'],
            ['Id_utilisateur'=> '1','Nom'=> 'FREDERIC','Prenom'=> 'Mathieu','TypeU'=> 'Eleve', 'image'=> '/assets/images/Utilisateurs/mathieu.png'],
            ['Id_utilisateur'=> '5','Nom'=> 'GARDET','Prenom'=> 'Fabien','TypeU'=> 'Eleve', 'image'=> '/assets/images/Utilisateurs/fabien.png'],
            ['Id_utilisateur'=> '8','Nom'=> 'LALANDE','Prenom'=> 'Gustave','TypeU'=> 'Eleve', 'image'=> '/assets/images/Utilisateurs/gustave.png'],
            ['Id_utilisateur'=> '9','Nom'=> 'MAZET','Prenom'=> 'Coralie','TypeU'=> 'Eleve', 'image'=> '/assets/images/Utilisateurs/coralie.png']
    
        ];


        require("../app/views/sadmins/formation.php");
    }

    public function exportFormation(int $id) {
        
    }

    

}