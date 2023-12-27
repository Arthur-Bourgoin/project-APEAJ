<?php
namespace App\Controllers;
use App\Models\TrainingModel;
use App\Models\UserModel;
use App\Class\ExportExcel;
use App\Class\Feedback;

class SAdminController extends UserController {

    public function __construct() {
        parent::__construct();
        if($_SESSION["role"] !== "super-admin") {
            require("../app/views/error403.php");
            exit();
        }
    }

    public function home() {
        $trainings = TrainingModel::getTrainings();
        $currentUser = UserModel::getUser($_SESSION["id"]);
        require("../app/views/sadmins/home.php");
    }

    public function infoTraining(int $idTraining) {
        if(!TrainingModel::existTraining($idTraining)) {
            require("../app/views/error404.php");
            exit();
        }
        $admins = UserModel::getAdmins();
        $students = UserModel::getStudents($idTraining);
        $training = TrainingModel::getTraining($idTraining);
        $currentUser = UserModel::getUser($_SESSION["id"]);
        require("../app/views/sadmins/formation.php");
    }

    public function add_user() {
        if(!$this->verifUser())
            Feedback::setError("Les informations de l'utilisateur ne sont pas valides.");
        else
            UserModel::addUser($_POST);
    }

    public function update_user() {
        if(!$this->verifUser($_POST))
            Feedback::setError("Mise à jour impossible, les informations ne sont pas valides.");
        else
            UserModel::updateUser($_POST);
    }

    public function delete_user() {
        if(!isset($_POST["idUser"]))
            Feedback::setError("Une erreur s'est produite lors de la suppression de l'utilisateur.");
        else
            UserModel::deleteUser($_POST["idUser"]);
    }

    public function add_training() {        
        if(!$this->verifTraining())
            Feedback::setError("Ajout impossible, les informations de la formation ne sont pas valides.");
        else
            TrainingModel::addTraining($_POST);
    }

    public function update_training() {
        if(!$this->verifTraining())
            Feedback::setError("Mise à jour impossible, les informations ne sont pas valides.");
        else
            TrainingModel::updateTraining($_POST);
    }

    public function delete_training() {
        TrainingModel::deleteTraining($_POST["idTraining"]);
        header("Location: /");
        exit();
    }

    /**
     * @todo to review
     */
    private function verifTraining(){
        if(
            //!isset($_POST["idTraining"]) ||
            empty($_POST["wording"])||
            empty($_POST["description"])||
            empty($_POST["qualifLevel"])
        )
            return false;
        return true;
    }

    /**
     * @todo to review
     */
    private function verifUser(){
        if (
            //!empty($_POST["idUser"]) ||
            empty($_POST["lastName"])||
            empty($_POST["firstName"])||
            //empty($_POST["picture"])||
            empty($_POST["typePwd"])||
            empty($_POST["pwd"])||
            empty($_POST["verifPwd"])
            //empty($_POST["role"])

        )
           return false;
        if($_POST["verifPwd"] !== $_POST["pwd"])
            return false;
        
        return true;
        
    }
    
    

}