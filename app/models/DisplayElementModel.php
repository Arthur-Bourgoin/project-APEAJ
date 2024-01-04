<?php
namespace App\Models;
use Config\Database;
use App\Models\FormModel;
use App\Class\Feedback;

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
        } finally {
            if(!empty($res))
                $res->closeCursor();
        }
    }

}