<?php

namespace App\Class;

class Form {

    private $idStudent;
    private $idForm;
    private $etatFiche;
    private $dateCreation;
    //.....
    private $newIntervention;

    private $elements;

    public function __construct($tab) {
        $this->elements = [
            "studentLastName" => new FormElement($tab[0]),
            "studentFirstName" => new FormElement($tab[1])
        ];
    }

    public function getPreview() {

    }

}