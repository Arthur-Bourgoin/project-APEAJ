<?php

namespace App\Classes;

class Form {
    private $userId;
    private $formId;
    private $status;
    private $creationDate;
    private $elementsFormMap; 

    public function __construct($userId, $number, $status, $creationDate) {
        $this->userId = $userId;
        $this->number = $number;
        $this->status = $status;
        $this->creationDate = $creationDate;
        $this->elementFormsMap = []; 
    }

    public function addElementForm(ElementForm $elementForm) {
        $this->elementsFormMap[$elementForm->getIdElementForm()] = $elementForm; 
    }

    public function getElementFormById($id) {
        return $this->elementsFormMap[$id] ?? null; 
    }

    public function getElementsForm() {
        return $this->elementsFormMap;
    }
    public function BasicForm(){
        $this->addElementForm(new ElementForm("studentLastName","text","",""));
        $this->addElementForm(new ElementForm("stdentFirstName","text","",""));
    }


}