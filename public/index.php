<?php

require_once("../vendor/autoload.php");

use App\Controllers\ {
    ConnexionController,
    UserController,
    StudentController,
    AdminController,
    SAdminController
};
use App\Class\ExportExcel;

session_start();
/*
$_SESSION["training"] = 1;
$_SESSION["idUser"] = 11; // romain laborde
$_SESSION["role"] = "educator-admin";
*/


if(!in_array($_SERVER["REQUEST_URI"], ["/choix-formation", "/connexion"])) {
    if(!isset($_SESSION["training"])) {
        header("Location: /choix-formation");
        exit();
    } elseif(!isset($_SESSION["role"])) {
        header("Location: /connexion");
        exit();
    }
}

$router = new AltoRouter();
//$router->setBasePath("/public/");

$router->map("GET", "/test-export-formation", function () {
    $xls = new ExportExcel();
    $xls->exportTraining(1);  
    $xls->getFileXLS("testFile.xlsx"); 
});
$router->map("GET", "/test-export-user", function () {
    $xls = new ExportExcel();
    $xls->exportUser(1);  
    $xls->getFileXLS("testFile.xlsx"); 
});

/*######################################################################################
                                      CONNECTION
#######################################################################################*/
$router->map("GET", "/choix-formation", function () {
    $controller = new ConnexionController();
    $controller->selectTraining();
});
$router->map("POST", "/choix-formation", function () {
    $controller = new ConnexionController();
    $controller->saveTraining();
});
$router->map("GET", "/connexion", function () {
    $controller = new ConnexionController();
    $controller->login();
});
$router->map("POST", "/connexion", function () {
    $controller = new ConnexionController();
    if(isset($_POST["action"])) {
        switch($_POST["action"]) {
            case "verifLogin":
                $controller->verifLogin();
                break;
            case "disconnectTraining":
                $controller->disconnect();
                break;
        }
    }
     else {
        $controller->login();
     }
});
$router->map("GET", "/disconnect", function() {
    $controller = new ConnexionController();
    $controller->disconnect();
});

/*######################################################################################
                                      HOME
#######################################################################################*/
$router->map("GET", "/", function () {
    $controller = new UserController();
    $controller->home();
});
$router->map("GET", "/accueil", function () {
    $controller = new UserController();
    $controller->home();
});
$router->map("POST", "/", function () {
    $controller = new UserController();
    $controller->homePOST();
    header("Location: " . $_SERVER["REQUEST_URI"]);
});
$router->map("POST", "/accueil", function () {
    $controller = new UserController();
    $controller->homePOST();
    header("Location: " . $_SERVER["REQUEST_URI"]);
});

/*######################################################################################
                                      STUDENT
#######################################################################################*/
$router->map("GET", "/fiche-[i:id]", function ($id) {
    $controller = new StudentController();
    $controller->infoForm($id);
});
$router->map("GET", "/fiche-[i:id]", function ($id) {
    $controller = new StudentController();
    if(isset($_POST["action"])) {
        switch($_POST["action"]) {
            case "addComment":
                $controller->add_comment();
                break;
            case "updateComment":
                $controller->update_comment();
                break;
            case "deleteComment":
                $controller->delete_comment();
                break;
        }
    } else {
        $controller->infoForm($id);
    }
});
$router->map("GET", "/fiche-[i:id]/consulter", function ($id) {
    $controller = new StudentController();
    $controller->consultForm($id);
});
$router->map("GET", "/fiche-[i:id]/completer", function ($id) {
    $controller = new StudentController();
    $controller->completeForm($id);
});
$router->map("POST", "/fiche-[i:id]/completer", function ($id) {
    $controller = new StudentController();
    $controller->update_form($id);
});

/*######################################################################################
                                      ADMIN
#######################################################################################*/
$router->map("GET", "/choix-modele-fiche", function () {
    $controller = new AdminController();
    $id = 1;
    $controller->chooseTemplate($id);
});
$router->map("GET", "/etudiants/[a]-[a]-[i:id]", function ($id) {
    $controller = new AdminController();
    $controller->infoStudent($id);
});

$router->map("GET", "/etudiants/suivi/[a]-[a]-[i:id]", function ($id) {
    $controller = new AdminController();
    $controller->statStudent($id);
}); 
$router->map("POST", "/etudiants/[a]-[a]-[i:id]", function ($id) {
    $controller = new AdminController();
    if(isset($_POST["action"])) {
        switch($_POST["action"]) {
            case "updateAccount":
                $controller->update_user("infoStudent", $id,null);
            case "updateUser":
                $controller->update_user("infoStudent", $id);
                break;
            case "addComment":
                $controller->add_commentStudent();
                break;
            case "updateComment":
                $controller->update_commentStudent();
                break;
            case "deleteComment":
                $controller->delete_commentStudent();
                break;
        }
        header("Location: " . $_SERVER["REQUEST_URI"]);
    } else {
        $controller->infoStudent($id);
    }
});
$router->map("GET", "/sessions/[i:id]", function ($id) {
    $controller = new AdminController();
    $controller->infoSession($id);
});
$router->map("POST", "/sessions/[i:id]", function ($id) {
    $controller = new AdminController();
    if(isset($_POST["action"])) {
        switch($_POST["action"]) {
            case "updateAccount":
                $controller->update_user("infoSession", $id,null);
                break;
            case "updateSession":
                $controller->update_session();
                break;
            case "closeSession":
                $controller->closeSession();
                break;
            case "deleteSession":
                $controller->deleteSession();
                break;
        }
        header("Location: " . $_SERVER["REQUEST_URI"]);
    } else {
        $controller->infoSession($id);
    }
});
$router->map("GET", "/etudiants/[a]-[a]-[i:idS]/fiche-[i:idF]", function ($idS, $idF) {
    $controller = new AdminController();
    $controller->infoForm($idS, $idF);
});
$router->map("POST", "/etudiants/[a]-[a]-[i:idS]/fiche-[i:idF]", function ($idS, $idF) {
    $controller = new AdminController();
    if(isset($_POST["action"])) {
        switch($_POST["action"]) {
            case "finishForm":
                $controller->finishForm($idS, $idF);
                break;
            case "deleteForm":
                $controller->delete_form($idS, $idF);
                break;
            case "addComment":
                $controller->add_commentForm($idS, $idF);
                break;
            case "updateComment":
                $controller->update_commentForm($idS, $idF);
                break;
            case "deleteComment":
                $controller->delete_commentForm($idS, $idF);
                break;
            case "addPicture":
                $controller->add_picture($idS, $idF);
                break;
            case "deletePicture":
                $controller->delete_picture($idS, $idF);
                break;
            case "updateAccount":
                $controller->update_user("infoForm", $idS,$idF,null);
                break;
        }
        header("Location: " . $_SERVER["REQUEST_URI"]);
    } else {
        $controller->infoForm($idS, $idF);
    }
});
$router->map("GET", "/etudiants/[a]-[a]-[i:idS]/creer-fiche", function ($idS) {
    $controller = new AdminController();
    $controller->createForm($idS);
});

/*######################################################################################
                                      SUPER ADMIN
#######################################################################################*/
$router->map("GET", "/formation-[i:id]", function ($id) {
    $controller = new SAdminController();
    $controller->infoTraining($id);
});
$router->map("POST", "/formation-[i:id]", function ($id) {
    $controller = new SAdminController();
    if(isset($_POST["action"])) {
        switch($_POST["action"]) {
            case "updateAccount":
                $controller->update_user();
                break;
            case "updateTraining":
                $controller->update_training();
                break;
            case "deleteTraining":
                $controller->delete_training();
                break;
            case "addUser":
                $controller->add_user();
                break;
            case "updateAdmin":
                $controller->update_user();
                break;
            case "deleteUser":
                $controller->delete_user();
                break;
        }
        header("Location: " . $_SERVER["REQUEST_URI"]);
    } else {
        $controller->infoTraining($id);
    }
});


$match = $router->match();
if($match != null) {
    call_user_func_array($match['target'], $match['params']);
} else {
    require("../app/views/error404.php");
}
