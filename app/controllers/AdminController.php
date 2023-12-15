<?php

namespace App\Controllers;

use App\Models\{
    AdminModel,
    SessionModel,
    UserModel,
    FormModel
};

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
        $formation = 1;
        $students = UserModel::getStudents($formation);
        $sessions = SessionModel::getSessions($formation);

        require("../app/views/admins/home.php");
    }

    public function myAccount()
    {
        echo "mon Compte";
    }

    public function infoStudent(string $fName, string $lName, int $id)
    {
        $student = UserModel::getUser($id);
        $currentForm = FormModel::getCurrentForm($id);
        $finishedForms = FormModel::getFinishedForms($id);
        require("../app/views/admins/details.php");
    }


    public function save_infoStudent(string $fName, string $lName, int $id)
    {
        $student = UserModel::getUser($id);
        $currentForm = FormModel::getCurrentForm($id);
        $finishedForms = FormModel::getFinishedForms($id);
        $typePwd = 0; // Valeur par défaut ou gestion d'une valeur non conforme
        if (isset($_POST["typePwd"])) {
            $typePwdValue = $_POST["typePwd"];
            if ($typePwdValue === "Texte") {
                $typePwd = 1;
            } elseif ($typePwdValue === "Schéma") {
                $typePwd = 3;
            } elseif ($typePwdValue === "Code") {
                $typePwd = 2;
            }
        }
        $result = UserModel::updateUser([
            "login" => $_POST["login"],
            "lastName" => $_POST["lastName"],
            "firstName" => $_POST["firstName"],
            "picture" => $_POST["picture"],
            "typePwd" => $typePwd,
            "pwd" => $_POST["pwd"],
            "role" => $_POST["role"],
            "idUser" => intval($_POST["idUser"]),
        ]);
        require("../app/views/admins/details.php");
    }

    public function infoSession(int $idSession)
    {
        $students = UserModel::getStudents(1);
        $forms = FormModel::getFormsBySession($idSession);
        $session = SessionModel::getSession($idSession);
        require("../app/views/admins/details-session.php");
    }

    public function save_infoSession(int $idSession)
    {
        $students = UserModel::getStudents(1);
        $forms = FormModel::getFormsBySession($idSession);
        $session = SessionModel::getSession($idSession);
        $result = SessionModel::updateSession([
            "wording" => $_POST["wording"],
            "theme" => $_POST["theme"],
            "description" => $_POST["description"],
            "timeBegin" => $_POST["timeBegin"],
            "idSession" => $_POST["idSession"]
        ]);

        require("../app/views/admins/details-session.php");
    }



    public function save_addSession()
{
    $formation = 1;
    $students = UserModel::getStudents($formation);
    $sessions = SessionModel::getSessions($formation);
    $result = SessionModel::addSession([
        "wording" => $_POST["wording"],
        "theme" => $_POST["theme"],
        "description" =>  $_POST["description"],
        "timeBegin" => $_POST["timeBegin"],
        "idTraining" => $_POST["idTraining"]
    ]);

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
        $student = UserModel::getUser($idStudent);
        $form = FormModel::getForm($idForm, $idStudent);
        require("../app/views/admins/fiche-info.php");
    }


}
