<?php

namespace App\Controllers;

use App\Models\ {
    AdminModel,
    SessionModel
};

class AdminController extends UserController
{

    public function __construct()
    {
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


    public function update_infoStudent(string $fName, string $lName, int $id)
    {
        $student = AdminModel::getStudentById($id);
        $fichesf = AdminModel::getFichesFiniesByStudentId($id);
        $fichesnf = AdminModel::getFichesNonFiniesByStudentId($id);
        $error=1;
        require("../app/views/admins/details.php");
    }

    public function infoSession(int $id)
    {
        $allstudents=AdminModel::getAllStudents();
        $students = AdminModel::getStudentsBySession($id);
        $session=AdminModel::getSessionById($id);
        $fiches = AdminModel::getFichesBySession($id);
        require("../app/views/admins/details-session.php");
    }

    public function update_infoSession(int $id)
    {
        $students = AdminModel::getStudentsBySession($id);
        $session=AdminModel::getSessionById($id);
        $fiches = AdminModel::getFichesBySession($id);
        $error=1;
        require("../app/views/admins/details-session.php");
    }

    public function add_session() {
        echo "Ajout d'une session";
    }

    public function save_addSession()
    {
        $students = AdminModel::getAllStudents();
        $sessions = AdminModel::getAllSessions();
        $formation = AdminModel::getFormationAdmin(1);
        $error = 0;
        require("../app/views/admins/home.php");
    }

    public function createForm(string $fName, string $lName, int $idStudent)
    {
        //echo "Creation d'une fiche pour " . $fName . " " . $lName . " id :" . $idStudent;
        $array = [
            [
                "id" => "studentLastName",
                "label" => "Nom de l'intervenant",
                "text" => "",
                "bold" => true,
                "italic" => false,
                "level" => 3,
                "picto" => "test.png",
                "fontFamily" => "'Segoe UI', sans-serif",
                "fontSize" => 16,
                "fontColor" => "#000000",
                "bgColor" => "#FFFFFF",
                "textToSpeechT" => "Nom de l'intervenant",
                "textToSpeech" => true,
                "active" => true
            ],
            [
                "id" => "studentFirstName",
                "label" => "Prénom de l'intervenant",
                "text" => "",
                "bold" => false,
                "italic" => false,
                "level" => 3,
                "picto" => "chalumeau2.jpg",
                "fontFamily" => "'Segoe UI', sans-serif",
                "fontSize" => 16,
                "fontColor" => "#000000",
                "bgColor" => "#CCCCCC",
                "textToSpeechT" => "Prénom de l'intervenant",
                "textToSpeech" => true,
                "active" => true
            ]
        ];
        $datas = json_encode($array);
        $dir = opendir("./assets/images/pictos");
        while (false !== ($filename = readdir($dir))) {
            $files[] = $filename;
        }
        closedir($dir);
        unset($files[0]);
        unset($files[1]);
        $files = array_values($files);
        //var_dump($files);
        $pictos = json_encode($files);
        require("../app/views/admins/fiche.php");
    }

    public function save_createForm()
    {
        // Model::getCurrentSession();
    }

    public function infoForm(string $fName, string $lName, int $idStudent, int $idForm, bool $edit = false)
    {
        $student = AdminModel::getStudentById($idStudent);
        $lName = $student["nom"];
        $fName = $student["prenom"];
        $form = AdminModel::getFormbyID($idForm);
        $coms = AdminModel::getComsByFormID($idForm);
        $pictures = AdminModel::getPicturesByFormID($idForm);
        require("../app/views/admins/fiche-info.php");
    }


}
