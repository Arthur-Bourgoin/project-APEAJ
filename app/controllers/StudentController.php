<?php

namespace App\Controllers;

class StudentController extends UserController {

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