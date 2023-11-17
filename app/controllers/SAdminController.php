<?php

namespace App\Controllers;

class SAdminController extends AdminController {

    public function home() {
        //code
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
        echo "Consultation de la formation : " . $id;
    }

    public function exportFormation(int $id) {

    }

}