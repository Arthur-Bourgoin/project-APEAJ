<?php
namespace App\Class;

class Session {

    public $idSession;
    public $wording;
    public $theme;
    public $description;
    public $timeBegin;
    public $timeEnd;

    public function __construct(object $obj) {
        $this->idSession = $obj->idSession;
        $this->wording = $obj->wording;
        $this->theme = $obj->theme;
        $this->description = $obj->description;
        $this->timeBegin = $obj->timeBegin;
        $this->timeEnd = $obj->timeEnd;
    }

}