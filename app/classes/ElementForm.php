<?php 

namespace App\Classes;

class ElementForm {
    private $idElementForm;
    private $type;
    private $text;
    private $audio;

    public function __construct($idElementForm, $type, $text, $audio) {
        $this->idElementForm = $idElementForm;
        $this->type = $type;
        $this->text = $text;
        $this->audio = $audio;
    }

    public function getIdElementForm() {
        return $this->idElementForm;
    }

    public function getType() {
        return $this->type;
    }

    public function getText() {
        return $this->text;
    }

    public function getAudio() {
        return $this->audio;
    }

    public function setIdElementForm($idElementForm) {
        $this->idElementForm = $idElementForm;
    }

    public function setType($type) {
        $this->type = $type;
    }

    public function setText($text) {
        $this->text = $text;
    }

    public function setAudio($audio) {
        $this->audio = $audio;
    }
}
