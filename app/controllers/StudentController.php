<?php

namespace App\Controllers;

class StudentController extends UserController {

    public function __construct() {
        parent::__construct();
        if($_SESSION["role"] !== "student") {
            require("../app/views/error403.php");
            exit();
        }
    }

    public function home() {
        echo "home Student";
    }

    public function infoForm(int $idF, bool $edit = false) {
        echo "Consultation de la fiche " . $idF;
    }

    public function fillForm() {
        echo "Fiche courante";
    }
}