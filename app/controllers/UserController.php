<?php

namespace App\Controllers;
use Config\Database;
use App\Models\AdminModel;

class UserController {

    private $linkpdo;

    public function __construct() {
        $this->linkpdo = Database::getInstance();
    }

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