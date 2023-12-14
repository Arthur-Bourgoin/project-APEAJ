<?php

namespace App\Controllers;
use Config\Database;
use App\Models\AdminModel;

class UserController {

    public function home() {
        if($_SESSION["role"] === "admin") {
            $controller = new AdminController();
            $controller->home();
        } elseif($_SESSION["role"] === "student") {
            $controller = new StudentController();
            $controller->home();
        } elseif($_SESSION["role"] === "sadmin") {
            $controller = new SAdminController();
            $controller->home();
        }
    }
    
    public function homePOST() {
        if($_SESSION["role"] === "admin") {
            $controller = new AdminController();
            $controller->home();
        } elseif($_SESSION["role"] === "student") {
            $controller = new StudentController();
            $controller->home();
        } elseif($_SESSION["role"] === "sadmin") {
            $controller = new SAdminController();
            if(isset($_POST["action"])) {
                switch($_POST["action"]) {
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

    public function login() {
        require("../app/models/AdminModel.php");
        $students = AdminModel::getAllStudents();
        require("../app/views/connexion.php");
    }

    public function verif_login() {
        echo "connexion";
        $_SESSION["id"]="6";
        header('Location: ../app/views/student/home_student.php');
        
    }




}