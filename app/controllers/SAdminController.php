<?php
namespace App\Controllers;
use App\Models\TrainingModel;
use App\Models\UserModel;

class SAdminController extends AdminController {

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
        if(!$this->verifUsers()){
            $error = 5;
        } else {
            $error = UserModel::addUser($_POST,$_POST["idTraining"]);
        }
        if($page === "home")
            $this->displayTemplateHome($error, $error===0 ? 3 : 0);
        else
            $this->displayTemplateTraining($error, $error===0 ? 2 : 0, $_POST["idTraining"]);
    }


    public function delete_user() {
        $error = UserModel::deleteUser($_POST["idUser"]);
        $this->displayTemplateTraining($error, $error===0 ? 3 : 0, $_POST["idTraining"]);
    }

    public function add_training() {        
        if(!$this->verifTraining()) {
            $error = 2;
        } else {
            $error = TrainingModel::addTraining($_POST);
        }
        $this->displayTemplateHome($error, $error===0 ? 1 : 0);
    }

    public function delete_training(string $page) {
        $error = TrainingModel::deleteTraining($_POST["idTraining"]);
        if($page === "home")
            $this->displayTemplateHome($error, $error===0 ? 2 : 0);
        else
            $this->displayTemplateTraining($error, $error===0 ? 2 : 0, $_POST["idTraining"]);
    }

    public function update_admin(){
        // A faire
    }

    public function update_training(){
        if(!$this->verifTraining()){
            $error = 3;
        } else {
            $error = TrainingModel::updateTraining($_POST);
        }
        $this->displayTemplateTraining($error, $error===0 ? 1 : 0, $_POST["idTraining"]);
    }

    private function displayTemplateHome(int $p_error, int $p_success) {
        $error = $p_error;
        $success = $p_success;
        $trainings = TrainingModel::getTrainings();
        if(!is_array($trainings) ) 
            $error = 1;
        require("../app/views/sadmins/home.php");
    }

    private function displayTemplateTraining(int $p_error, int $p_success, int $idTraining) {
        $error = $p_error;
        $success = $p_success;
        $admins = UserModel::getAdmins();
        $students = UserModel::getStudents($idTraining);
        $training = TrainingModel::getTraining($idTraining);
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

    private function verifUsers(){
        if (
            //!empty($_POST["idUser"]) ||
            empty($_POST["lastName"])||
            empty($_POST["firstName"])||
            empty($_POST["picture"])||
            empty($_POST["typePwd"])||
            empty($_POST["pwd"])||
            empty($_POST["verifPwd"])||
            empty($_POST["role"])

        ) 
           return false;

        if($_POST["verifPwd"]!== $_POST["pwd"])
            return false;
        
        return true;
        
    }
    
    

}