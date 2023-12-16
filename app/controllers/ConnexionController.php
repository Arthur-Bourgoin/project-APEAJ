<?php
namespace App\Controllers;
use Config\Database;
use App\Models\ {
    TrainingModel,
    UserModel
};

class ConnexionController {

    public function selectTraining() {
        if(isset($_SESSION["training"])) {
            if(isset($_SESSION["role"]))
                header("Location: /");
            else
                header("Location: /connexion");
        } else {
            $trainings = TrainingModel::getTrainings();
            require("../app/views/selectTraining.php");
        }
    }

    public function saveTraining() {
        $_SESSION["training"] = $_POST["idTraining"];
        header("Location: /connexion");
    }

    public function login() {
        if(!isset($_SESSION["training"])) {
            unset($_SESSION["training"]);
            header("Location: /choix-formation");
        } else {
            try {
                if(!TrainingModel::existTraining($_SESSION["training"])) {
                    unset($_SESSION["training"]);
                    header("Location: /choix-formation");
                } else {
                    $admins = UserModel::getAdmins();
                    $students = UserModel::getStudents($_SESSION["training"]);
                    require("../app/views/connexion.php");
                }
            } catch (\Exception $e) {
                unset($_SESSION["training"]);
                header("Location: /choix-formation");
            }
        }
    }

    public function verifLogin() {
        var_dump($_POST); exit();
        require("../app/views/connexion.php");
    }

}