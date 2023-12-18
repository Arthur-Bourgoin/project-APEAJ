<?php

require_once("../vendor/autoload.php");

use App\Controllers\ {
    ConnexionController,
    UserController,
    StudentController,
    AdminController,
    SAdminController
};

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

$router->map("GET", "test-export", function () {
    $xls = new ExportExcel();
    $xls->exportTraining($idTraining);
    $xls->getFileXLS("testFile.xls");
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
    $controller->verifLogin();
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
});
$router->map("POST", "/accueil", function () {
    $controller = new UserController();
    $controller->homePOST();
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
$router->map("GET", "/etudiants/[a]-[a]-[i:id]", function ($id) {
    $controller = new AdminController();
    $controller->infoStudent($id);
});
$router->map("POST", "/etudiants/[a]-[a]-[i:id]", function ($id) {
    $controller = new AdminController();
    if(isset($_POST["action"])) {
        switch($_POST["action"]) {
            case "updateAccount":
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
                $controller->update_user($_SESSION["idUser"], "infoSession", $id);
                break;
            case "updateSession":
                $controller->update_session();
                break;
            case "closeSession":
                $controller->closeSession();
                break;
        }
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
                $controller->finishForm();
                break;
            case "deleteForm":
                $controller->delete_form();
                break;
            case "addComment":
                $controller->add_commentForm();
                break;
            case "updateComment":
                $controller->update_commentForm();
                break;
            case "deleteComment":
                $controller->delete_commentForm();
                break;
            case "addPicture":
                $controller->add_picture();
                break;
            case "deletePicture":
                $controller->delete_picture();
                break;
        }
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
                $controller->update_user(); // update_admin()
                break;
            case "deleteUser":
                $controller->delete_user();
                break;
        }
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
