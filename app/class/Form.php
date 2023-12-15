<?php

namespace App\Class;

class Form {

   public $form;
   public $comments;
   public $pictures;
   public $elements;
   public $materials;
   public $session;
   public $student;
   public $educator;

    public function __construct(object $form,?array $comments,?array $pictures,?array $elements,?array $materials,?object $session,?object $student,?object $educator) {
        $this->form = $form;
        $this->comments = $comments;
        $this->pictures = $pictures;
        $this->elements = $elements;
        $this->materials = $materials;
        $this->session = $session;
        $this->student = $student;
        $this->educator = $educator;
    }
}