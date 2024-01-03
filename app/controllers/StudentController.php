<?php

namespace App\Controllers;
use App\Models\{
    FormModel,
    UserModel,
    CommentFormModel,
    PictureModel
};
use App\Class\Feedback;



class StudentController extends UserController {

    public function __construct() {
        parent::__construct();
        if($_SESSION["role"] !== "student") {
            require("../app/views/error403.php");
            exit();
        }
    }

    public function home() {
        $student = UserModel::getUser($_SESSION['id']);
        $finishedForms = FormModel::getFinishedForms($student->idUser);
        $currentForm = FormModel::getCurrentForm($student->idUser);
        require("../app/views/students/home_student.php");
    }

    public function infoForm(int $numero) {
        if(!FormModel::existForm($numero, $_SESSION["id"])) {
            require("../app/views/error404.php");
            exit();
        }
        $student = UserModel::getUser($_SESSION["id"]);
        $form = FormModel::getForm($numero, $student->idUser);
        require("../app/views/students/fiche-info.php");
    }


    public function consultForm(int $idF) {} 


    public function add_comment() {
        $_POST["admin"] = false;
        if(!$this->verifComment($_POST))
            Feedback::setError("Le commentaire ne peut pas être ajouté");
        else
            CommentFormModel::addComment($_POST,$_SESSION["id"]);
    }

    public function update_comment() {
        $_POST["admin"] = false;
        if(!$this->verifComment($_POST))
            Feedback::setError("Erreur lors de la modification du commentaire");
        else
            CommentFormModel::updateComment($_POST);
    }

    public function delete_comment() {
        CommentFormModel::deleteComment($_POST["idCommentForm"]);
    }

    public function add_picture($idForm) {
        $_POST['numero'] = $idForm;
        $_POST['idStudent'] = $_SESSION["id"];
        $_POST['idAuthor'] = $_SESSION["id"];
        $this->saveFormPicture('path');
        if(!$this->verifPicture($_POST))
            Feedback::setError("Informations de la photo incorrectes");
        else
            PictureModel::addPicture($_POST); 
    } 

    public function delete_picture($idForm) {
        $idPicture = $_POST["idPicture"];
        $uploadDir = 'assets/images/pictures/'; // Chemin vers ton dossier d'images
        $picturePath = $uploadDir . PictureModel::getPicture($idPicture)->path;
        // Vérification si le fichier existe avant de le supprimer
        if (file_exists($picturePath)) {
            if (unlink($picturePath)) {
                // Suppression réussie du fichier, maintenant supprime de la base de données
                PictureModel::deletePicture($idPicture);
            } else {
                // Erreur lors de la suppression du fichier
                Feedback::setError("Erreur lors de la suppression!");
            }
        } else {
            // Le fichier n'existe pas
            Feedback::setError("Erreur: fichier à supprimer non trouvé"); // Par exemple, code d'erreur personnalisé pour fichier non trouvé
        }
    }

    public function completeForm(int $idF) {}

    public function update_form(int $idF) {}

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
                }
            } else {
                Feedback::setError("L'image n'est pas renseignée ou le fichier n'est pas une image !");
            }
        } else {
            Feedback::setError("L'image n'est pas renseignée ou le fichier n'est pas une image !");
        }
    }

}