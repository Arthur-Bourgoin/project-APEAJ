<?php

namespace App\Controllers;
use App\Models\StudentModel;
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
        $finishedSheets = StudentModel::getFinishedSheets();
        $currentSheet = StudentModel::getCurrentSheet();
        $student = AdminModel::getStudentById($_SESSION['id']);
        require("../app/views/students/home_student.php");
    }

    public function infoForm(int $idF) {
        echo "Consultation de la fiche " . $idF;
    }

    public function consultForm(int $idF) {} 

    public function add_comment() {}

    public function update_comment() {}

    public function delete_comment() {}

    public function completeForm(int $idF) {}

    public function update_form(int $idF) {}

}