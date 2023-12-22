<?php

namespace App\Controllers;

use App\Models\{
    AdminModel,
    SessionModel,
    UserModel,
    FormModel,
    CommentFormModel,
    PictureModel,
    CommentStudentModel,
    TrainingModel

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
    public function update_user(string $page, ?int $id, ?int $id2)
    {  
        $allowed_roles = array('educator-admin', 'educator', 'CIP', 'super-admin');
        $this->saveProfilePicture('picture');
        if(!$this->verifUser($_POST)){
            $error = 501;
        }
        
        if($_POST["action"] === "updateStudent") {
            if (in_array($_SESSION['role'], $allowed_roles)){
            switch(true) {
                case empty(trim($_POST['pwd'])):
                    $error = UserModel::updateUser($_POST);
                    break;
                default:
                    $error = UserModel::updateUserAndPwd($_POST);
                    break;
                }
            }else {
                require("../app/views/error403.php");
            }
            switch($page) {
                case "home":
                    $this->displayTemplateHome($error,$error===0 ? 2 : 0); break;
                case "infoStudent":
                    $this->displayTemplateInfoStudent($error,$error===0 ? 1 : 0, $id); break;
            }
        }
        else {
            if($_SESSION['id']==$_POST["idUser"]){
                switch(true) {
                    case empty(trim($_POST['pwd'])):
                        $error = UserModel::updateUser($_POST);
                        break;
                    default:
                        $error = UserModel::updateUserAndPwd($_POST);
                        break;
                    }
            }else{
                $error=707;
            }
            switch($page) {
                case "home":
                    $this->displayTemplateHome($error,$error===0 ? 12 : 0); break;
                case "infoStudent":
                    $this->displayTemplateInfoStudent($error,$error===0 ? 12 : 0, $id); break;
                case "infoSession":
                    $this->displayTemplateInfoSession($error,$error===0 ? 12 : 0, $id); break;
                case "infoForm":
                    $this->displayTemplateInfoForm($error,$error===0 ? 12 : 0, $id,$id2); break;
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

    public function closeSession() 
    {
        $error = SessionModel::closeSession($_POST["idSession"]);
        $this->displayTemplateInfoSession($error, $error===0 ? 2 : 0, $_POST["idSession"]);
    }

    public function add_commentStudent() {
        $error=CommentStudentModel::addComment($_POST,$_SESSION["id"]);
        $this->displayTemplateInfoStudent($error, $error===0 ? 3 : 0, $_POST["idStudent"]);
    }
    public function update_commentStudent() {
        $error=CommentStudentModel::updateComment($_POST,$_SESSION["id"]);
        $this->displayTemplateInfoStudent($error, $error===0 ? 4 : 0, $_POST["idStudent"]);
        }
    public function delete_commentStudent() {
        $error=CommentStudentModel::deleteComment($_POST["idStudent"],$_POST["idEducator"]);
        $this->displayTemplateInfoStudent($error, $error===0 ? 2 : 0, $_POST["idStudent"]);
    }

    public function infoForm(int $idStudent, int $idForm)
    {
        $this->displayTemplateInfoForm(0,0,$idStudent,$idForm);
    }

    public function finishForm() {}

    public function deleteForm() {}

    public function add_commentForm($idStudent, $idForm) {
        $_POST["admin"] = isset($_POST["admin"]) ? true : false;
        $_POST["idAuthor"] = $_SESSION['id'];
        if(!$this->verifComment($_POST)){
            $error = 1;}
        else
        $error = CommentFormModel::addComment($_POST,$_SESSION["id"]);
    $this->displayTemplateInfoForm($error, $error===0 ? 1 : 0, $idStudent, $idForm);
    }
    public function update_commentForm($idStudent, $idForm) {
        $_POST["admin"] = isset($_POST["admin"]) ? true : false;
    if(!$this->verifComment($_POST))
        $error = 1;
    else
        $error = CommentFormModel::updateComment($_POST);
        
    $this->displayTemplateInfoForm($error, $error===0 ? 2 : 0, $idStudent, $idForm);
    }
    public function delete_commentForm($idStudent, $idForm) {
        $error = CommentFormModel::deleteComment($_POST["idCommentForm"]);
        $this->displayTemplateInfoForm($error, $error===0 ? 3 : 0, $idStudent, $idForm);
    }

    public function add_picture($idStudent, $idForm) {
        $idAuthor = $_SESSION['id'];
        $_POST['numero'] = $idForm;
        $_POST['idStudent'] = $idStudent;
        $error=$this->saveFormPicture('path');
        if($error !==0){
            $this->displayTemplateInfoForm($error, $error===0 ? 4 : 0, $idStudent, $idForm); 
        }
        else{
            if(!$this->verifPicture($_POST))
                $error = 4;
            else
                $error = PictureModel::addPicture($_POST,$idAuthor);
            $this->displayTemplateInfoForm($error, $error===0 ? 4 : 0, $idStudent, $idForm);   
        }
    } 
    public function delete_picture($idStudent, $idForm) {
        $idPicture = $_POST["idPicture"];
        $uploadDir = 'assets/images/pictures/'; // Chemin vers ton dossier d'images
        $picturePath = $uploadDir . PictureModel::getPicture($idPicture)->path;
    // Vérification si le fichier existe avant de le supprimer
        if (file_exists($picturePath)) {
            if (unlink($picturePath)) {
                // Suppression réussie du fichier, maintenant supprime de la base de données
                $error = PictureModel::deletePicture($idPicture);
            } else {
                // Erreur lors de la suppression du fichier
                $error = 6; // Par exemple, code d'erreur personnalisé pour la suppression du fichier
            }
        } else {
            // Le fichier n'existe pas
            $error = 7; // Par exemple, code d'erreur personnalisé pour fichier non trouvé
        }
    
        $this->displayTemplateInfoForm($error, $error === 0 ? 5 : 0, $idStudent, $idForm);
    }

    public function chooseTemplate($id){
        $student = UserModel::getUser($id);
        $formTemplates = FormModel::getForms(1000);
        require("../app/views/admins/chooseTemplate.php");
    }

    public function createForm(int $idStudent)
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
        $currentUser=$this->getCurrentUser();
        $training = TrainingModel::getTraining($_SESSION["training"]);
        $students = UserModel::getStudents($training->idTraining);
        $sessions = SessionModel::getSessions($training->idTraining);
        
        if(!is_array($students) || !is_array($sessions)) 
            $error = 1;
        require("../app/views/admins/home.php");
    }

    private function displayTemplateInfoStudent(int $p_error, int $p_success,int $id){
        $error = $p_error;
        $success = $p_success;
        $student = UserModel::getUser($id);
        $comments =CommentStudentModel::getComments($id);
        $currentForm = FormModel::getCurrentForm($id);
        $finishedForms = FormModel::getFinishedForms($id);
        $currentUser=$this->getCurrentUser();
        if(is_int($currentForm) || !is_array($finishedForms) || is_int($student)|| is_int($comments)) 
            $error = 1;
        require("../app/views/admins/details.php");

    }
    
    private function displayTemplateInfoSession(int $p_error, int $p_success,int $id){
        $error = $p_error;
        $success = $p_success;
        $students = UserModel::getStudents(1);
        $forms = FormModel::getFormsBySession($id);
        $session = SessionModel::getSession($id);
        $currentUser=$this->getCurrentUser();
        if(!is_array($students) || !is_array($forms) || is_int($session)) 
            $error = 1;
        require("../app/views/admins/details-session.php");

    }
    private function displayTemplateInfoForm(int $p_error, int $p_success,int $idStudent, int $idForm){
        $error = $p_error;
        $success = $p_success;    
        $student = UserModel::getUser($idStudent);
        $form = FormModel::getForm($idForm, $idStudent);
        $currentUser=$this->getCurrentUser();
        if( is_int($student) || is_int($form))     
            $error = 1; 
        require("../app/views/admins/fiche-info.php");
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
    private function verifClosingSession(array $args){
        if($args["timeBegin"]>$args["timeEnd"])
            return false;
        return true;
    }
    private function verifUser(array $args){
        if(
            empty($args["idUser"]) ||
            empty($args["lastName"]) ||
            empty($args["firstName"]) ||
            empty($args["picture"]) 
        )
            return false;
        return true;
    }
    private function verifComment(array $args){
        if(
            empty($args["wording"]) ||
            empty($args["text"])  
        )
            return false;
        return true;
    }

    private function verifPicture(array $args){
        if(
            empty($args["title"]) 
        )
            return false;
        return true;
    }
    
    private function saveProfilePicture(String $name){
        $uploadDir = 'assets/images/users/'; 
        if (isset($_FILES[$name]) && $_FILES[$name]['error'] === UPLOAD_ERR_OK) { 
            $uploadFile = $uploadDir . basename($_FILES[$name]['name']); 
            if (move_uploaded_file($_FILES[$name]['tmp_name'], $uploadFile)) {
                $_POST['picture'] = basename($_FILES[$name]['name']);
            } else {
                $_POST['picture'] = str_replace($uploadDir, '', UserModel::getUser($_POST['idUser'])->picture);
                $_POST['picture'] = ltrim($_POST['picture'], '/');
            }
        }
        else
           $_POST['picture'] = str_replace($uploadDir, '', UserModel::getUser($_POST['idUser'])->picture);
           $_POST['picture'] = ltrim($_POST['picture'], '/');


    }

    private function saveFormPicture(string $name) {
        $uploadDir = 'assets/images/pictures/';
        $allowedExtensions = array('jpg', 'jpeg', 'png', 'gif','wbep','svg');
    
        if (isset($_FILES[$name]) && $_FILES[$name]['error'] === UPLOAD_ERR_OK && in_array(strtolower(pathinfo($_FILES[$name]['name'], PATHINFO_EXTENSION)), $allowedExtensions)
        ) {
            $imageData = file_get_contents($_FILES[$name]['tmp_name']);
    
            // Vérification que les données sont une image
            if (@imagecreatefromstring($imageData)) {
                $extension = pathinfo($_FILES[$name]['name'], PATHINFO_EXTENSION);
                $photoCount = PictureModel::getNbPictures();
                $uploadFile = $uploadDir . ($photoCount + 1) . '.' . $extension;
    
                if (move_uploaded_file($_FILES[$name]['tmp_name'], $uploadFile)) {
                    $_POST['path'] = ($photoCount + 1) . '.' . $extension;
                    return $error=0;
                } else {
                    return $error=10;
                }
            } else { 
                return $error=102;
            }
        } else {
            return $error=102;
        }
    }
    private function getCurrentUser(){
        return UserModel::getUser($_SESSION['id']);
    }
    
}