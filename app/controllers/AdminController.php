<?php

namespace App\Controllers;

use App\Models\{
    AdminModel,
    SessionModel,
    UserModel,
    FormModel
};

/*
TODO
1) pour tout les controllers qui ne sont pas "d'affichage" (ceux qui sont en POST)
   pense à tester tous les codes de retour possibles avant de faire fonctionner le modèle
2) Si les méthodes n'ont pas de paramètres soit:
    - Elles n'en ont pas besoin
    - Il faut utiliser les valeurs dans $_POST
    - J'ai fait une erreur
3) Marque en haut du fichier tous les codes d'erreurs et à quoi ils correspondent
4) Documente les fonctions si besoin

Le paramère $id de la méthode update_user() correspond soit à l'id de la session 
(pour la page infoSession), soit à l'id de l'étudiant (pour la page infoStudent),
soit "null" (pour la page home). L'id de l'utilisateur à modifier (soit l'id d'un 
étudiant soit l'id de l'éducateur lui même) doit se trouver dans $_POST.

Il faudrait modifier la page infoForm afin de mettre en place une note par commentaire,
l'éducateur qui ajouter un commentaire ajoutera aussi une note (modal). Note qu'on
divise pas 5 pour pouvoir afficher un des 5 smileys en haut à droite de chaque commentaire.

Les modèles contiennent surement pas mal de petites erreurs, demande moi avant de modifier.
*/

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
      $this->displayTemplatehome(0,0);
    }

    public function infoStudent(int $id)
    {
        $this->displayTemplateInfoStudent(0,0,$id);
    }

    /**
     * @param string $page --> the page to display
     * @param integer $id --> idSession OR idStudent OR null (depending on the page to display)
     *                    --> != $_POST["idUser"]
     */
    public function update_user(?string $page, ?int $id)
    {
        if(!$this->verifUser($_POST)){
            $error=1;
        }
        else  {
            $error = UserModel::updateUser($_POST);
        }
        if($_POST["action"] === "updateStudent") {
            switch($page) {
                case "home":
                    $this->displayTemplateHome($error,$error===0 ? 1 : 0); break;
                case "infoStudent":
                    $this->displayTemplateInfoStudent($error,$error===0 ? 1 : 0, $id); break;
            }
        }
        else {
            switch($page) {
                case "home":
                    $this->displayTemplateHome($error,$error===0 ? 1 : 0); break;
                case "infoStudent":
                    $this->displayTemplateInfoStudent($error,$error===0 ? 1 : 0, $id); break;
                case "infoSession":
                    $this->displayTemplateInfoSession($error,$error===0 ? 1 : 0, $id); break;
            }
        }
    }

    public function infoSession(int $idSession)
    {
        $this->displayTemplateInfoSession(0,0,$idSession);
    }

    public function add_session()
    {   
        if(!$this->verifSession($_POST))
            $error=1;
        else
            $error = SessionModel::addSession($_POST);
        $this->displayTemplatehome($error,$error===0 ? 1 : 0);
    }

    public function update_session()
    {
        if(!$this->verifSession($_POST))
            $error=1;
        else
            $error = SessionModel::updateSession($_POST);
        $this->displayTemplateInfoSession($error, $error===0 ? 1 : 0, $_POST["idSession"]);
    }

    public function closeSession() {}

    public function add_commentStudent() {}

    public function update_commentStudent() {}

    public function delete_commentStudent() {}

    public function infoForm(int $idStudent, int $idForm)
    {
        $student = UserModel::getUser($idStudent);
        $form = FormModel::getForm($idForm, $idStudent);
        require("../app/views/admins/fiche-info.php");
    }

    public function finishForm() {}

    public function deleteForm() {}

    public function add_commentForm() {}

    public function update_commentForm() {}

    public function delete_commentForm() {}

    public function add_picture() {}

    public function delete_picture() {}

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
    private function verifUser(array $args){
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
