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
        if ($_SESSION["role"] === "student") {
            require("../app/views/error403.php");
            exit();
        }
    }

    public function home()
    {
      $this->displayTemplatehome(0,0);
    }

    public function myAccount()
    {
        echo "mon Compte";
    }

    public function infoStudent(string $fName, string $lName, int $id)
    {
        $this->displayTemplateInfoStudent(0,0,$id);
    }


    public function update_student(string $fName, string $lName, int $id)
    {
        if(!$this->verifStudent($_POST)){
            $error=1;
        }
        else  {
                switch ($_POST["typePwd"]) {
                    case "Texte":
                        $_POST["typePwd"] = 1;
                    case "Schéma":
                        $_POST["typePwd"] = 3;
                    case "Code":
                        $_POST["typePwd"] = 2;
                    
                }
            $error = UserModel::updateUser($_POST);
            }
       $this->displayTemplateInfoStudent($error,$error===0 ? 1 : 0,$id);
    }

    public function infoSession(int $idSession)
    {
        $this->displayTemplateInfoSession(0,0,$idSession);
    }

    public function update_session(int $idSession)
    {
        if(!$this->verifSession($_POST))
            $error=1;
        else
            $error = SessionModel::updateSession($_POST);
        $this->displayTemplateInfoSession($error,$error===0 ? 1 : 0,$idSession);
    }



    public function add_session()
    {   
        if(!$this->verifSession($_POST))
            $error=1;
        else
            $error = SessionModel::addSession($_POST);
        $this->displayTemplatehome($error,$error===0 ? 1 : 0);
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

    private function displayTemplatehome(int $p_error, int $p_success) {
        $error = $p_error;
        $success = $p_success;
        $formation = 1;
        $students = UserModel::getStudents($formation);
        $sessions = SessionModel::getSessions($formation);
        if(!is_array($students) || !is_array($sessions)) 
            $error = 1;
        require("../app/views/admins/home.php");
    }
    private function displayTemplateInfoStudent(int $p_error, int $p_success,int $id){
        $error = $p_error;
        $success = $p_success;
        $student = UserModel::getUser($id);
        $currentForm = FormModel::getCurrentForm($id);
        $finishedForms = FormModel::getFinishedForms($id);
        if(is_int($currentForm) || !is_array($finishedForms) || is_int($student)) 
            $error = 1;
        require("../app/views/admins/details.php");

    }
    private function displayTemplateInfoSession(int $p_error, int $p_success,int $id){
        $error = $p_error;
        $success = $p_success;
        $students = UserModel::getStudents(1);
        $forms = FormModel::getFormsBySession($id);
        $session = SessionModel::getSession($id);
        if(!is_array($students) || !is_array($forms) || is_int($session)) 
            $error = 1;
        require("../app/views/admins/details-session.php");

    }
    private function verifSession(array $args){
        if(
            empty($args["wording"]) ||
            empty($args["theme"]) ||
            empty($args["description"]) ||
            empty($args["timeBegin"]) ||
            empty($args["idTraining"]) 
        )
            return false;
        return true;
    }
    private function verifStudent(array $args){
        if(
            empty($args["idUser"]) ||
            empty($args["lastName"]) ||
            empty($args["firstName"]) ||
            //empty($args["picture"]) ||
            empty($args["typePwd"]) ||
            empty($args["pwd"]) ||
            empty($args["role"]) 
        )
            return false;
        return true;
    }

    
}
