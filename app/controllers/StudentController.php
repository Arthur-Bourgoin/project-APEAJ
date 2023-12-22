<?php

namespace App\Controllers;
use App\Models\{
    FormModel,
    UserModel
};
use App\Models\AdminModel;

class StudentController extends UserController {

    public function __construct() {
        parent::__construct();
        if($_SESSION["role"] !== "student") {
            require("../app/views/error403.php");
            exit();
        }
    }

    public function home() {
        $student = UserModel::getUser($_SESSION['id']);
        $finishedForms = FormModel::getFinishedForms($student->idUser);
        $currentForm = FormModel::getCurrentForm($student->idUser);
        require("../app/views/students/home_student.php");
    }

    public function infoForm(int $idStudent, int $numero) {
        $error = 0;
        $success = 0;  
        //echo "Consultation de la fiche " . $numero;
        $student = UserModel::getUser($idStudent);
        $form = FormModel::getForm($numero, $idStudent);
        if( is_int($student) || is_int($form))     
            $error = 1; 
        require("../app/views/students/fiche-info.php");
    }

    public function consultForm(int $idF) {} 

    public function add_comment() {}

    public function update_comment() {}

    public function delete_comment() {}

    public function completeForm(int $idF) {}

    public function update_form(int $idF) {}

}