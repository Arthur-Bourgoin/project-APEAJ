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
$router->map("GET", "/creer-session", function () {
    $controller = new AdminController();
    $controller->addSession();
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
$router->map("GET", "/creer-formation", function () {
    $controller = new SAdminController();
    $controller->addFormation();
});
$router->map("GET", "/formation-[i:id]", function ($id) {
    $controller = new SAdminController();
    $controller->consultFormation($id);
});
$router->map("POST", "/etudiants/[a:fName]-[a:lName]-[i:id]", function ($fName, $lName, $id) {
    $controller = new AdminController();
    $controller->save_infoStudent($fName, $lName, $id);
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