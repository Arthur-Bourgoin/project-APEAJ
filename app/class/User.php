<?php

namespace App\Class;

class User {

    public $idUser;
    public $login;
    public $lastName;
    public $firstName;
    public $picture;
    public $typePwd;
    public $role;
    public $idTraining;

    public $comments;


    public function __construct(object $obj, array $comments) {
        $this->idUser=$obj->idUser;
        $this->login=$obj->login;
        $this->lastName=$obj->lastName;
        $this->firstName=$obj->firstName;
        $this->picture=$obj->picture;
        $this->typePwd=$obj->typePwd;
        $this->role=$obj->role;
        $this->idTraining=$obj->idTraining;
        $this->comments = $comments;
    }

    public function getBsCard() {

    }

    // $footer = "connexion" || "sadmin" || "admin"
    public function getDenomination($footer): String {

    }

    public function getCardConnexion() {
        switch($this->typePwd){
            case 1:
                $target = "modalConnexionTexte";break;
            case 2:
                $target = "modalConnexionCode";break;
            case 3:
                $target = "modalConnexionSchema";break;
        }
        ob_start();?>
        <div class="card mb-4 mx-2 col-lg-3 col-md-4 col-6 border-dark" data-id="<?= $this->idUser ?>" data-bs-toggle="modal" data-bs-target="#<?=$target?>">
            <img src="<?= htmlentities($this->picture)?>" class="img-thumbnail border-0 mt-4" alt="Photo de l'étudiant <?= htmlentities($this->idUser)?>">
            <div class="card-body text-center">'
                <h5 class="card-title"><?=htmlentities($this->lastName)?></h5>
                <p class="card-text"><?= htmlentities($this->firstName)?></p>
            </div>
        </div>
        <?php
        return ob_get_clean();
    }




}