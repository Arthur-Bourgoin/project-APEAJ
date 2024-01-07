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
    public function update_user(string $page)
    {   if($_POST["action"]==="updateAccount"){
            $allowed_roles = array('educator-admin', 'educator', 'CIP', 'super-admin');
        }else{
            $allowed_roles = array('educator-admin', 'super-admin');
        }
        if(!$this->verifUser($_POST)){
            Feedback::setError("Les informations de l'utilisateur ne sont pas valides.");
            return;
        }
        $this->saveProfilePicture('picture');
        
            if (in_array($_SESSION['role'], $allowed_roles)){
                if( isset($_POST["pwd"]) && empty(trim($_POST['pwd']))) {
                    UserModel::updateUser($_POST);}
                else{
                    if(!$this->verifPwd($_POST)){
                        Feedback::setError("Le code ne respecte pas le format attendu");
                    }
                    else{
                        UserModel::updateUserAndPwd($_POST);
                    }
                }
            }else {
                Feedback::setError("Vous ne possedez pas les droits");
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
    {   if (in_array($_SESSION['role'], array('educator-admin', 'educator', 'CIP', 'super-admin'))) {
            if(!$this->verifSession($_POST)){
                Feedback::setError("Les informations de la session ne sont pas valides.");
            }
            else
                SessionModel::addSession($_POST);
        }else {
            Feedback::setError("Vous ne possedez pas les droits");
        }   
    }

    public function update_session()
    {   if (in_array($_SESSION['role'], array('educator-admin', 'educator', 'CIP', 'super-admin'))) {
            if(!$this->verifSession($_POST)){
                Feedback::setError("Les informations de la session ne sont pas valides.");
            }
            else
                SessionModel::updateSession($_POST);
        }else {
            Feedback::setError("Vous ne possedez pas les droits");
        }
    }

    public function closeSession() 
    {   if (in_array($_SESSION['role'], array('educator-admin', 'educator', 'CIP', 'super-admin'))) {
            SessionModel::closeSession($_POST["idSession"]);
        }else {
            Feedback::setError("Vous ne possedez pas les droits");
        }
    }   

    public function deleteSession() 
    {   if (in_array($_SESSION['role'], array('educator-admin','super-admin'))) {
            SessionModel::deleteSession($_POST["idSession"]);
            header("Location: /");
            exit();
        }else {
            Feedback::setError("Vous ne possedez pas les droits");
        }
    } 

    public function add_commentStudent() {
        if (in_array($_SESSION['role'], array('educator-admin', 'educator', 'CIP', 'super-admin'))) {
            $_POST["idEducator"]=$_SESSION["id"];
            if(!$this->verifCommentStudent($_POST)){
                Feedback::setError("Les informations du commentaire ne sont pas valides.");
            }else
                CommentStudentModel::addComment($_POST);
        }else {
            Feedback::setError("Vous ne possedez pas les droits");
        }
    }
    public function update_commentStudent() {
        if (in_array($_SESSION['role'], array('educator-admin', 'educator', 'CIP', 'super-admin'))) {
            if(!$this->verifCommentStudent($_POST)){
                Feedback::setError("Les informations du commentaire ne sont pas valides.");
            }else
                CommentStudentModel::updateComment($_POST);
        }else {
            Feedback::setError("Vous ne possedez pas les droits");
        }
    }
    public function delete_commentStudent() {
        if (in_array($_SESSION['role'], array('educator-admin', 'educator', 'CIP', 'super-admin'))) {
            CommentStudentModel::deleteComment($_POST["idStudent"],$_SESSION["id"]);
        }else {
            Feedback::setError("Vous ne possedez pas les droits");
        }
    }


    public function infoForm(int $idStudent, int $idForm)
    {   
        $student = UserModel::getUser($idStudent);
        $form = FormModel::getForm($idForm, $idStudent);
        $currentUser=$this->getCurrentUser();
        require("../app/views/admins/fiche-info.php");
    }

    public function finishForm() {
        if (in_array($_SESSION['role'], array('educator-admin', 'educator', 'CIP', 'super-admin'))) {
            FormModel::finishForm($_POST["numero"],$_POST["idStudent"]);
        }else {
            Feedback::setError("Vous ne possedez pas les droits");
        }
    }
    
    public function deleteForm() {}

    public function add_commentForm() {
        $_POST["admin"] = isset($_POST["admin"]);
        $_POST["idAuthor"] = $_SESSION['id'];
        if(!$this->verifComment($_POST)){
            Feedback::setError("Les données du commentaire ne sont pas valides");      
        }
        else
            CommentFormModel::addComment($_POST,$_SESSION["id"]);
    }
    public function update_commentForm() {
        $_POST["admin"] = isset($_POST["admin"]);
        if(!$this->verifComment($_POST)){
            Feedback::setError("Les données du commentaire ne sont pas valides");      
        }
        else
            CommentFormModel::updateComment($_POST);
    }
    public function delete_commentForm() {
        CommentFormModel::deleteComment($_POST["idCommentForm"]);
    }

    public function add_picture($idStudent, $idForm) {
        $_POST['numero'] = $idForm;
        $_POST['idStudent'] = $idStudent;
        $_POST['idAuthor']= $_SESSION['id'];
        if(!$this->verifPicture($_POST))
            Feedback::setError("Les informations de la photo ne sont pas bonnes");
        elseif(empty($_FILES["path"]["name"]))
            Feedback::setError("Vous n'avez pas renseigné de photo");
        else{
            $this->saveFormPicture('path');
            PictureModel::addPicture($_POST);
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
                PictureModel::deletePicture($idPicture);
            } else {
                Feedback::setError("Erreur lors de la suppresion du fichiers");
            }
        } else {
            Feedback::setError("Fichier non trouvé");
        }
    
    }

    public function statStudent($id){
        $student = UserModel::getUser($id);
        $forms = FormModel::getForms($id);
        $currentUser=$this->getCurrentUser();
        $tabLevels=[];
        $tabNotes=[]; 
        $tablink=[];
        foreach($forms as $form){
            $dateFormatted = date('d/m/Y', strtotime($form->form->creationDate));
            $tabLevels[$dateFormatted] = $form->avgLevels;
            $tabNotes[$dateFormatted] = $form->avgNotes;
            $tablink[$dateFormatted] = "/etudiants/{$student->lastName}-{$student->firstName}-{$student->idUser}/fiche-{$form->form->numero}";
        } 
        require("../app/views/admins/statStudent.php");
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
            return (!empty($args["wording"]) &&
            !empty($args["theme"]) &&
            !empty($args["description"]) &&
            !empty($args["timeBegin"]) &&
            !empty($args["idTraining"]) );
    }
    private function verifClosingSession(array $args){
        return ($args["timeBegin"]<$args["timeEnd"]);
    }
    private function verifUser(array $args){
            return (!empty($args["idUser"]) &&
            !empty($args["lastName"]) &&
            !empty($args["firstName"]));
    }
    private function verifComment(array $args){
        return (!empty($args["wording"]) &&
            !empty($args["text"])  &&
            !empty($args["note"])  &&
            ctype_digit($args["note"]) );
    }

    private function verifPicture(array $args){
        return !empty($args["title"]);
    }

    private function verifPwd(array $args) {
        if($args["pwd"]!==$args["verifPwd"]){
            return false;  
        }
        if($args["typePwd"] === "2" ){
            return ctype_digit($args["pwd"]);}
        return true;
    }

    private function verifCommentStudent(array $args){
        return !empty($args["text"]);
    }
    
    private function saveProfilePicture(String $name){
        $uploadDir = 'assets/images/users/'; 
        if (isset($_FILES[$name]) && $_FILES[$name]['error'] === UPLOAD_ERR_OK) { 
            $uploadFile = $uploadDir . basename($_FILES[$name]['name']); 
            if (move_uploaded_file($_FILES[$name]['tmp_name'], $uploadFile)) {
                $_POST['picture'] = strtolower(basename($_FILES[$name]['name']));
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
                $extension = strtolower(pathinfo($_FILES[$name]['name'], PATHINFO_EXTENSION));
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
            }
        } else {
            Feedback::setError("Le fichier n'est pas une image ou rencontre un problème");
        }
    }
    private function getCurrentUser(){
        return UserModel::getUser($_SESSION['id']);
    }

}