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

    public function infoForm(int $idF, bool $edit = false) {
        echo "Consultation de la fiche " . $idF;
    }

    public function fillForm() {
        echo "Fiche courante";
    }
}