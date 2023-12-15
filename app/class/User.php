<?php

namespace App\Class;

class User {

    public $idUser;
    public $login;
    public $lastName;
    public $firstName;
    public $picture;
    public $typePwd;
    public $pwd;
    public $role;
    public $idtraing;

    public function __construct(int $id,string $login,string $lastName,string $firstName,string $picture,string $typePwd,string $pwd,int $idtraing) {
        $this->id = $id;
        $this->login = $login;
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->picture = $picture;
        $this->typePwd = $typePwd;
        $this->pwd = $pwd;
        $this->idtraing = $idtraing;
    }




}