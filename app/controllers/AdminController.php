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
    TrainingModel,
};
use App\Class\Feedback;
use PHPUnit\Framework\Constraint\IsEmpty;

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
        $currentUser=$this->getCurrentUser();
        $training = TrainingModel::getTraining($_SESSION["training"]);
        $students = UserModel::getStudents($training->idTraining);
        $sessions = SessionModel::getSessions($training->idTraining);
        require("../app/views/admins/home.php");
    }

    public function infoStudent(int $id)
    {
        if(!UserModel::existUser($id)) {
            require("../app/views/error404.php");
            exit();
        }
        $student = UserModel::getUser($id);
        $comments =CommentStudentModel::getComments($id);
        $currentForm = FormModel::getCurrentForm($id);
        $finishedForms = FormModel::getFinishedForms($id);
        $currentUser=$this->getCurrentUser();
        require("../app/views/admins/details.php");
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
            Feedback::setError("Les informations de l'utilisateur ne sont pas valides.");
        }
        if($_POST["action"] === "updateStudent") {
            if (in_array($_SESSION['role'], $allowed_roles)){
                if(empty(trim($_POST['pwd'])))
                    UserModel::updateUser($_POST);
                else{
                    if(!$this->verifPwd($_POST))
                        Feedback::setError("Le code ne respecte pas le format attendu");
                    else
                        UserModel::updateUserAndPwd($_POST);
                    
                }
            }else {
                require("../app/views/error403.php");
            }
        }
        else {
            if($_SESSION['id']==$_POST["idUser"]){
                if (in_array($_SESSION['role'], $allowed_roles)){
                    if(empty(trim($_POST['pwd'])))
                        UserModel::updateUser($_POST);
                    else{
                        if(!$this->verifPwd($_POST))
                            Feedback::setError("Le code ne respecte pas le format attendu");
                        else
                            UserModel::updateUserAndPwd($_POST);
                    }
                }else
                    Feedback::setError("Vous navez pas les droits de modifier ce compte");    
            }
        }
    }
    public function infoSession(int $id)
    {
        $students = UserModel::getStudents(1);
        $forms = FormModel::getFormsBySession($id);
        $session = SessionModel::getSession($id);
        $currentUser=$this->getCurrentUser();
        require("../app/views/admins/details-session.php");
    }

    public function add_session()
    {   
        if(!$this->verifSession($_POST)){
            Feedback::setError("Les informations de la session ne sont pas valides.");
        }
        else
            SessionModel::addSession($_POST);
    }

    public function update_session()
    {
        if(!$this->verifSession($_POST)){
            Feedback::setError("Les informations de la session ne sont pas valides.");
        }
        else
            SessionModel::updateSession($_POST);
    }

    public function closeSession() 
    {
        SessionModel::closeSession($_POST["idSession"]);
    }   

    public function deleteSession() 
    {  
        SessionModel::deleteSession($_POST["idSession"]);
        header("Location: /");
        exit();
    
    } 

    public function add_commentStudent() {
        $_POST["idEducator"]=$_SESSION["id"];
        if(!$this->verifCommentStudent($_POST)){
            Feedback::setError("Les informations du commentaire ne sont pas valides.");
        }else
            CommentStudentModel::addComment($_POST);
        
    }
    public function update_commentStudent() {
        if(!$this->verifCommentStudent($_POST)){
            Feedback::setError("Les informations du commentaire ne sont pas valides.");
        }else
            CommentStudentModel::updateComment($_POST);
    
}
    public function delete_commentStudent() {
        CommentStudentModel::deleteComment($_POST["idStudent"],$_SESSION["id"]);
        }


    public function infoForm(int $idStudent, int $idForm)
    {   
        $student = UserModel::getUser($idStudent);
        $form = FormModel::getForm($idForm, $idStudent);
        $currentUser=$this->getCurrentUser();
        require("../app/views/admins/fiche-info.php");
    }

    public function finishForm() {
        FormModel::finishForm($_POST["numero"],$_POST["idStudent"]);
    }
    
    public function deleteForm() {}

    public function add_commentForm($idStudent, $idForm) {
        $_POST["admin"] = isset($_POST["admin"]) ? true : false;
        $_POST["idAuthor"] = $_SESSION['id'];
        if(!$this->verifComment($_POST)){
            Feedback::setError("Les données du commentaire ne sont pas valides");      
        }
        else
            CommentFormModel::addComment($_POST,$_SESSION["id"]);
    }
    public function update_commentForm($idStudent, $idForm) {
        $_POST["admin"] = isset($_POST["admin"]) ? true : false;
        if(!$this->verifComment($_POST)){
            Feedback::setError("Les données du commentaire ne sont pas valides");      
        }
        else
            CommentFormModel::updateComment($_POST);
    }
    public function delete_commentForm($idStudent, $idForm) {
        CommentFormModel::deleteComment($_POST["idCommentForm"]);
    }

    public function add_picture($idStudent, $idForm) {
        $idAuthor = $_SESSION['id'];
        $_POST['numero'] = $idForm;
        $_POST['idStudent'] = $idStudent;
        $_POST['idAuthor']= $_SESSION['id'];
        $this->saveFormPicture('path');
        if(!$this->verifPicture($_POST))
            Feedback::setError("Les informations de la photo ne sont pas bonnes");
        elseif(empty($_POST['path']))
            Feedback::setError("Vous n'avez pas renseigné de photo");
        else
            PictureModel::addPicture($_POST);
           
    }
     
    public function delete_picture($idStudent, $idForm) {
        $idPicture = $_POST["idPicture"];
        $uploadDir = 'assets/images/pictures/'; // Chemin vers ton dossier d'images
        $picturePath = $uploadDir . PictureModel::getPicture($idPicture)->path;
    // Vérification si le fichier existe avant de le supprimer
        if (file_exists($picturePath)) {
            if (unlink($picturePath)) {
                // Suppression réussie du fichier, maintenant supprime de la base de données
                PictureModel::deletePicture($idPicture);
            } else {
                Feedback::setError("Erreur lors de la suppresion du fichiers");
            }
        } else {
            Feedback::setError("Fichier non trouvé");
        }
    
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
                "picto" => "pictoUrgency.png",
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
                "picto" => "pictoTravaux.png",
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
            empty($args["text"])  ||
            !ctype_digit($args["note"]) ||
            empty($args["note"])  
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

    private function verifPwd(array $args) {
        if($args["pwd"]!==$args["verifPwd"]){
            return false;
        }
        switch ($args["typePwd"]) {
            case 2:
                if (ctype_digit($args["pwd"])) {
                    return true;
                } else {
                    return false;
                }
                break;
            default:
                return true; // Mettre d'accord sur le format mot de passe et schéma
                break;
            }
    }

    private function verifCommentStudent(array $args){
        if( 
            empty($args["text"]) 
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
                } else {
                    Feedback::setError("Erreur lors du téléchargement du fichier");
                    exit();
                }
            } else { 
                Feedback::setError("Le fichier envoyé n'est pas une image");
                exit();
            }
        } else {
            Feedback::setError("Le fichier n'est pas une image ou rencontre un problème");
        }
    }
    private function getCurrentUser(){
        return UserModel::getUser($_SESSION['id']);
    }

}