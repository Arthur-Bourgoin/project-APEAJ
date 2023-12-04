<?php

namespace App\Controllers;

use App\Models\AdminModel;

class AdminController extends UserController
{

    public function __construct()
    {
        parent::__construct();
        if ($_SESSION["role"] === "student") {
            require("../app/views/error403.php");
            exit();
        }
    }

    public function home()
    {

        $students = AdminModel::getAllStudents();
        $sessions = AdminModel::getAllSessions();
        $formation = AdminModel::getFormationAdmin(1);

        require("../app/views/admins/home.php");
    }

    public function myAccount()
    {
        echo "mon Compte";
    }

    public function infoStudent(string $fName, string $lName, int $id)
    {
        $student = AdminModel::getStudentById($id);
        $fichesf = AdminModel::getFichesFiniesByStudentId($id);
        $fichesnf = AdminModel::getFichesNonFiniesByStudentId($id);
        require("../app/views/admins/details.php");
    }


    public function save_infoStudent(string $fName, string $lName, int $id)
    {
        var_dump($_POST);
    }

    public function infoSession(int $id)
    {
            $students = AdminModel::getStudentsBySession($id);
            $description = AdminModel::getDescription($id);
            $fiches = AdminModel::getFichesBySession($id);
            require("../app/views/admins/details-session.php");
        }
    

    public function save_infoSession(int $id)
    {
        echo "Session id : " . $id;
    }

    public function addSession()
    {
        echo "Ajout d'une session";
    }

    public function save_addSession()
    {
        //code
    }

    public function createForm(string $fName, string $lName, int $idStudent)
    {
        echo "Creation d'une fiche pour " . $fName . " " . $lName . " id :" . $idStudent;
        require("../app/views/admins/fiche.php");
    }

    public function save_createForm()
    {
        // Model::getCurrentSession();
    }

    public function infoForm(string $fName, string $lName, int $idStudent, int $idForm, bool $edit = false)
    {
        $student = AdminModel::getStudentById($idStudent);
        $form = AdminModel::getFormbyID($idForm);
        $coms = AdminModel::getComsByFormID($idForm);
        $pictures = AdminModel::getPicturesByFormID($idForm);
        require("../app/views/admins/fiche-info.php");
    }


}
