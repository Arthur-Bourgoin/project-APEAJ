<?php

namespace App\Controllers;

class AdminController extends UserController {

    public function home() {
        echo "home Admin";
    }

    public function myAccount() {
        echo "mon Compte";
    }

    public function infoStudent(string $fName, string $lName, int $id) {
        echo $fName . " " . $lName . "</br>";
        echo "ID : " . $id;
    }

    public function save_infoStudent(string $fName, string $lName, int $id) {
        //code
    }

    public function infoSession(int $id) {
        if($_SESSION["role"] === "student") {
            require("../app/views/error403.php");
        } else {
            echo "Session id : " . $id;
        }
    }

    public function save_infoSession(int $id) {
        echo "Session id : " . $id;
    }

    public function addSession() {
        echo "Ajout d'une session";
    }

    public function save_addSession() {
        //code
    }
    
    public function createForm(string $fName, string $lName, int $idStudent) {
        echo "Creation d'une fiche pour " . $fName . " " . $lName . " id :" . $idStudent;
    }

    public function save_createForm() {
        // Model::getCurrentSession();
    }

    public function infoForm(string $fName, string $lName, int $idStudent, int $idForm, bool $edit = false) {
        echo "Consultation de la fiche " . $idForm . " de l'étudiant " . $fName . " " . $lName . " " . $idStudent;
    }


}
