<?php
require_once '../app/controllers/Controller.php';

$url = $_SERVER["REQUEST_URI"];
$controller = new Controller();

if($url === "/" || $url === "/accueil") {
    $controller->index();
} else if($url === "/login") {
    echo "login";
} else if($url === "/admin") {
    echo "admin";
} else {
    echo "Template page 404";
}
