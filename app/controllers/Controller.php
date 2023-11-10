<?php

require("../app/models/UserModel.php");

class Controller {
    public function index() {
        $users = UserModel::getAllUsers();

        require("../app/views/homeView.php");
    }
}