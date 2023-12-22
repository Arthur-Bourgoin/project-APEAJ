<?php
namespace App\Controllers;
use App\Models\TrainingModel;
use App\Models\UserModel;
use App\Class\ExportExcel;

/*
code d'erreur:
0** --> code d'erreur lors d'une requete d'affichage
    - 1 : Une erreur s'est produite lors de l'initialisation de la page
1** --> code d'erreur lors d'une requete d'ajout
    - 101 : Une erreur s'est produite lors de l'ajout d'un utilisateur
    - 102 : Une erreur s'est produite lors de l'ajout d'une formation
    - ...
2** --> code d'erreur lors d'une requete de modification
    - 201 : Une erreur s'est produite lors de la modification de l'utilisateur
    - 202 : Une erreur est survenue lors de la modification de la formation
    - ...
3** --> code d'erreur lors d'une requete de suppression
    - 301 : Une erreur s'est produite lors de la suppression d'une formation
    - ...
4** --> code d'erreur si la ressource demandée n'existe pas
    - 401 : utilisateur n'existe pas
    - 404 : formation n'existe pas
    - ...
5** --> Les informations rentrées ne sont pas valides
    - 501 : les informations de l'utilisateur ne sont pas valides
    - 503 : les informations de le formation ne sont pas valides
    - ...

SUCCES
1 --> succes lors de l'ajout d'un utilisateur
2 --> succes lors de l'ajout d'une formation
3 --> succes lors de la suppression d'une formation 
4 --> succes lors de la modification de la formation
5 --> succes mors de la modification d'un utilisateur
6 --> succes lors de la suppression d'une formation

TODO --> code erreur suppression (voir pour l'export) + rajouter les required
*/

class SAdminController extends UserController {

    public function __construct() {
        parent::__construct();
        if($_SESSION["role"] !== "super-admin") {
            require("../app/views/error403.php");
            exit();
        }
    }

    public function home() {
        $this->displayTemplateHome(0, 0);
    }

    public function infoTraining(int $idTraining) {
        $this->displayTemplateTraining(0, 0, $idTraining);
    }

    public function add_user(string $page) {
        if(!$this->verifUser()){
            $error = 501;
        } else {
            $error = UserModel::addUser($_POST,$_POST["idTraining"]);
        }
        if($page === "home")
            $this->displayTemplateHome($error, $error===0 ? 1 : 0);
        else
            $this->displayTemplateTraining($error, $error===0 ? 1 : 0, $_POST["idTraining"]);
    }

    public function update_user(){
        if(!$this->verifUser($_POST)){
            $error = 501;
        }
        else  {
            $error = UserModel::updateUser($_POST);
        }
        $this->displayTemplateTraining($error, $error===0 ? 5 : 0, $_POST["idTraining"]);
    }

    public function delete_user() {
        //$error = UserModel::deleteUser($_POST["idUser"]);
        $error = 0;
        $this->displayTemplateTraining($error, $error===0 ? 6 : 0, $_POST["idTraining"]);
    }

    public function add_training() {        
        if(!$this->verifTraining()) {
            $error = 503;
        } else {
            $error = TrainingModel::addTraining($_POST);
        }
        $this->displayTemplateHome($error, $error===0 ? 2 : 0);
    }

    public function update_training(){
        if(!$this->verifTraining()){
            $error = 503;
        } else {
            $error = TrainingModel::updateTraining($_POST);
        }
        $this->displayTemplateTraining($error, $error===0 ? 4 : 0, $_POST["idTraining"]);
    }

    public function delete_training() {
        if(!TrainingModel::existTraining($_POST["idTraining"]))
            return 1; // training not exist
        $error = TrainingModel::deleteTraining($_POST["idTraining"]);
        $this->displayTemplateHome($error, $error===0 ? 3 : 0);
    }

    private function displayTemplateHome(int $p_error, int $p_success) {
        $error = $p_error;
        $success = $p_success;
        $trainings = TrainingModel::getTrainings();
        $currentUser = UserModel::getUser($_SESSION["id"]);
        if(!is_array($trainings)) 
            $error = 1;
        require("../app/views/sadmins/home.php");
    }

    private function displayTemplateTraining(int $p_error, int $p_success, int $idTraining) {
        $error = $p_error;
        $success = $p_success;
        $admins = UserModel::getAdmins();
        $students = UserModel::getStudents($idTraining);
        $training = TrainingModel::getTraining($idTraining);
        $currentUser = UserModel::getUser($_SESSION["id"]);
        if(!is_array($admins) || !is_array($students)  || is_int($training)) 
            $error = 1;
        require("../app/views/sadmins/formation.php");
    }

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

    private function verifUser(){
        if (
            //!empty($_POST["idUser"]) ||
            empty($_POST["lastName"])||
            empty($_POST["firstName"])||
            //empty($_POST["picture"])||
            empty($_POST["typePwd"])||
            empty($_POST["pwd"])||
            empty($_POST["verifPwd"])||
            empty($_POST["role"])

        )
           return false;
        if($_POST["verifPwd"] !== $_POST["pwd"])
            return false;
        
        return true;
        
    }
    
    

}