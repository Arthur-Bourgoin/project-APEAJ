<?php
namespace App\Models;
use Config\Database;
class MaterialModel {

    public static function getMaterials(int $numero, int $idStudent) {
        try {
            if(!FormModel::existForm($numero, $idStudent))
                return 2; // form not exist
            $res = Database::getInstance()->prepare("SELECT * FROM material 
                                                     WHERE idMaterial in (SELECT idMaterial FROM used WHERE numero = :numero AND idStudent = :id)");
            $res->execute(array("id" => $idStudent, "numero" => $numero));
            return $res->fetchAll();
        } catch (\Exception $e) {
            return 1; // query error
        } finally {
            if(!empty($res))
                $res->closeCursor();
        }
    }

}