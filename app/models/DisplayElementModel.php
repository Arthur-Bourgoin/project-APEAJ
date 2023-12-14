<?php
namespace App\Models;

class DisplayElementModel {

    public static function getDisplayElements(int $numero, int $idStudent) {
        try {
            if(!FormModel::existForm($numero, $idStudent))
                return 1; // form not exist
            $res = Database::getInstance()->prepare("SELECT * FROM display WHERE numero = :numero AND idStudent = :id");
            $res->execute(array("id" => $idStudent, "numero" => $numero));
            return $res->fetchAll();
        } catch (\Exception $e) {
            return 2; // query error
        }
    }

}