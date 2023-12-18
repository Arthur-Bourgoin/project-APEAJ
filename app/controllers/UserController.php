<?php

namespace App\Controllers;
use Config\Database;
use App\Models\UserModel;


class UserController {

    public function __construct() {
        if(!isset($_SESSION["training"])) {
            header("Location: /choix-formation");
            exit();
        }
        if(!isset($_SESSION["role"])) {
            header("Location: /connexion");
            exit();
        }
    }

    public function home() {
        if($_SESSION["role"] === "student") {
            $controller = new StudentController();
            $controller->home();
        } elseif(in_array($_SESSION["role"], ["educator", "educator-admin", "CIP"])) {
            $controller = new AdminController();
            $controller->home();
        } elseif($_SESSION["role"] === "super-admin") {
            $controller = new SAdminController();
            $controller->home();
        } else {
            echo "Erreur normalement impossible";
            exit();
        }
    }
    
    public function homePOST() {
        if ($_SESSION["role"] === "student") 
        {
            $controller = new StudentController();
            $controller->home();
        } 
        elseif (in_array($_SESSION["role"], ["educator", "educator-admin", "CIP"]))
        {
            $controller = new AdminController();
            if(isset($_POST["action"])) {
                switch($_POST["action"]) {
                    case "addSession":
                        $controller->add_session();
                        break;
                    case "updateStudent":
                    case "updateAccount":
                        $controller->update_user("home", null);
                        break;
                }
            } else {
                $controller->home();
            }
        } 
        elseif($_SESSION["role"] === "super-admin") 
        {
            $controller = new SAdminController();
            if(isset($_POST["action"])) {
                switch($_POST["action"]) {
                    case "updateAccount":
                        $controller->update_user();
                    case "addTraining":
                        $controller->add_training();
                        break;
                    case "deleteTraining":
                        $controller->delete_training();
                        break;
                    case "addUser":
                        $controller->add_user();
                        break;
                }
            } else {
                $controller->home();
            }
        }
    }

}