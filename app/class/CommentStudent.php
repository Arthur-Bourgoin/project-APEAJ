<?php

namespace App\Class;
use App\Class\User;

class CommentStudent {

    public $idStudent;
    public $text;
    public $lastModif;
    public $educator;

    public function __construct(object $comment, User $educator) {
        $this->idStudent = $comment->idStudent;
        $this->text = $comment->text;
        $this->lastModif = $comment->lastModif;
        $this->educator = $educator;
    }

}