<?php

namespace App\Controllers;

class UserController {
    public function home() {
        if($_SESSION["role"] === "admin") {
            $controller = new AdminController();
            $controller->home();
        } elseif($_SESSION["role"] === "student") {
            $controller = new StudentController();
            $controller->home();
        } 
    } 

    public function login() {
        echo "connexion";
    }

    public function verif_login() {
        echo "connexion";
    }




}