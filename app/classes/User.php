<?php

namespace App\Classes;

class User {

    private $id;
    private $login;
    private $lastName;
    private $firstName;
    private $picture;
    private $typePwd;
    private $pwd;
    private $role;

    public function __construct($id, $login, $lastName, $firstName, $picture, $typePwd, $pwd, $role) {
        $this->id = $id;
        $this->login = $login;
        $this->lastName = $lastName;
        $this->firstName = $firstName;
        $this->picture = $picture;
        $this->typePwd = $typePwd;
        $this->pwd = $pwd;
        $this->role = $role;
    }

    // $footer = "connexion"  "sadmin"  "admin"
    public function getBsCard($footer) {
        $card = '<div class="col-lg-3 col-md-4 col-6">';
        $card .= '<div class="card mb-4">';
        $card .= '<img src="' . $this->picture . '" class="img-thumbnail" alt="Photo de l\'étudiant ">';
        $card .= '<div class="card-body text-center">';
        $card .= '<h5 class="card-title">' . htmlentities($this->lastName) . '</h5>';
        $card .= '<p class="card-text">' . htmlentities($this->firstName) . '</p>';
        $card .= '<a href="etudiants/' . htmlentities($this->lastName) . '-' . htmlentities($this->firstName) . '-' . htmlentities($this->id) . '"';
        
        switch ($footer) {
            case "connexion":
                $card .= ' class="btn btn-primary">Connexion</a>';
                break;
            case "sadmin":
                $card .= ' class="btn btn-secondary">Sadmin</a>';
                break;
            case "admin":
                $card .= ' class="btn btn-primary">Informations</a>';
                break;
            default:
                $card .= ' class="btn btn-primary">Informations</a>';
                break;
        }
        
        $card .= '</div></div></div>';
        
        return $card;
    }

    public function getDenomination(): string {
        return $this->firstName . ' ' . $this->lastName;
    }

    public function getId(): int {
        return $this->id;
    }

    public function getLogin(): string {
        return $this->login;
    }

    public function getLastName(): string {
        return $this->lastName;
    }

    public function getFirstName(): string {
        return $this->firstName;
    }

    public function getPicture(): string {
        return $this->picture;
    }

    public function getTypePwd(): string {
        return $this->typePwd;
    }

    public function getPwd(): string {
        return $this->pwd;
    }

    public function getRole(): string {
        return $this->role;
    }

    public function setId($id) {
        $this->id = $id;
    }

    public function setLogin($login) {
        $this->login = $login;
    }

    public function setLastName($lastName) {
        $this->lastName = $lastName;
    }

    public function setFirstName($firstName) {
        $this->firstName = $firstName;
    }

    public function setPicture($picture) {
        $this->picture = $picture;
    }

    public function setTypePwd($typePwd) {
        $this->typePwd = $typePwd;
    }

    public function setPwd($pwd) {
        $this->pwd = $pwd;
    }

    public function setRole($role) {
        $this->role = $role;
    }




}