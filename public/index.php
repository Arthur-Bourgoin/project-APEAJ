<?php

require_once("../vendor/autoload.php");

use App\Controllers\ {
    UserController,
    StudentController,
    AdminController,
    SAdminController
};

session_start();
$_SESSION["role"] = "admin";
$_SESSION['id'] = 3;
if(!isset($_SESSION["role"])) {
    $controller = new UserController();
    $controller->login();
    exit();
}

$router = new AltoRouter();
//$router->setBasePath("/public/");

$router->map("GET", "/", function () {
    $controller = new UserController();
    $controller->home();
});
$router->map("GET", "/accueil", function () {
    $controller = new UserController();
    $controller->home();
});
$router->map("GET", "/connexion", function () {
    $controller = new UserController();
    $controller->login();
});
$router->map("GET", "/etudiants/[a:fName]-[a:lName]-[i:id]", function ($fName, $lName, $id) {
    $controller = new AdminController();
    $controller->infoStudent($fName, $lName, $id);
});
$router->map("GET", "/sessions/[i:id]", function ($id) {
    $controller = new AdminController();
    $controller->infoSession($id);
});
$router->map("GET", "/fiche-[i:id]", function ($id) {
    $controller = new StudentController();
    $controller->infoForm($id);
});
$router->map("GET", "/fiche-courante", function () {
    $controller = new StudentController();
    $controller->fillForm();
});
$router->map("GET", "/etudiants/[a:fName]-[a:lName]-[i:idS]/fiche-[i:idF]", function ($fName, $lName, $idS, $idF) {
    $controller = new AdminController();
    $controller->infoForm($fName, $lName, $idS, $idF);
});
$router->map("GET", "/etudiants/[a:fName]-[a:lName]-[i:idS]/creer-fiche", function ($fName, $lName, $idS) {
    $controller = new AdminController();
    $controller->createForm($fName, $lName, $idS);
});
$router->map("GET", "/creer-utilisateur", function () {
    $controller = new SAdminController();
    $controller->addUser();
});
$router->map("GET", "/formation-[i:id]", function ($id) {
    $controller = new SAdminController();
    $controller->consultFormation($id);
});
$router->map("POST", "/formation-[i:id]", function ($id) {
    $controller = new SAdminController();
    if(isset($_POST["action"])) {
        switch($_POST["action"]) {
            case "updateAccount":
                $controller->update_account();
                break;
            case "deleteTraining":
                $controller->delete_training();
                break;
            case "updateTraining":
                $controller->update_training();
                break;
            case "addUser":
                $controller->add_user();
                break;
            case "updateAdmin":
                $controller->update_admin();
                break;
            case "deleteUser":
                $controller->delete_user();
                break;
        }
    } else {
        $controller->infoTraining($id);
    }
});
$router->map("POST", "/etudiants/[a:fName]-[a:lName]-[i:id]", function ($fName, $lName, $id) {
    $controller = new AdminController();
    $controller->update_student($fName, $lName, $id);
});
<<<<<<< HEAD
=======
$router->map("POST", "/", function () {
    $controller = new AdminController();
    $controller->add_session();
});
>>>>>>> 49b37add5ecb1a1fa5f2938c11934302f2b4928c

$router->map("POST", "/sessions/[i:id]", function ($id) {
    $controller = new AdminController();
    $controller->update_session($id);
});

$match = $router->match();
if($match != null) {
    call_user_func_array($match['target'], $match['params']);
} else {
    require("../app/views/error404.php");
}


/*
Test sur le role dans routeur, constructeur controller ou fonction controlleur
*/