<?php

namespace App\Class;

class Training {

    const PATH_IMG = "/assets/images/trainings/";
    public $idTraining;
    public $wording;
    public $description;
    public $qualifLevel;
    public $picture;

    public function __construct(object $obj) {
        $this->idTraining=$obj->idTraining;
        $this->wording=$obj->wording;
        $this->description=$obj->description;
        $this->qualifLevel=$obj->qualifLevel;
        $this->picture = self::PATH_IMG . $obj->picture;
    }

    public function getBsCard() {

    }

    // $footer = "connexion" || "sadmin" || "admin"
    public function getDenomination($footer): String {

    }

    public function getCardChooseTraining() {
        ob_start();?>
        <form action="<?= $_SERVER["REQUEST_URI"] ?>" method="POST" class="row mb-3 col-12 col-md-5">
            <input type="hidden" name="idTraining" value="<?= $this->idTraining ?>">
            <div class="divTraining d-flex align-items-center border border-dark rounded-3" role="button">
                <div class="col-10 col-md-4">
                    <div class="text-center">
                        <img src= <?= $this->picture ?> class="w-75 my-4">
                    </div>
                </div>
                <div class="col-8">
                    <h3 class="fw-bold text-center lh-base"><?= htmlentities($this->wording)?></h3>
                </div>
            </div>
        </form>
        <?php
        return ob_get_clean();
       
    }

}