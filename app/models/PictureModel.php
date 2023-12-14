<?php
namespace App\Models;
use Config\Database;
use App\Models\FormModel;

class PictureModel {

    public static function getPictures(int $numero, int $idStudent) {
        try {
            if(!FormModel::existForm($numero, $idStudent))
                return 2; // form not exist
            $res = Database::getInstance()->prepare("SELECT * FROM picture WHERE numero = :numero AND idStudent = :id");
            $res->execute(array("id" => $idStudent, "numero" => $numero));
            return $res->fetchAll();
        } catch (\Exception $e) {
            return 1; // query error
        } finally {
            if(!empty($res))
                $res->closeCursor();
        }
    }

    public static function addPicture(array $args, int $idAuthor) {
        try {
            if(!FormModel::existForm($args["numero"], $args["idStudent"]))
                return 2; // form not exist
            $args["idAuthor"] = $idAuthor;
            Database::getInstance()
                ->prepare("INSERT INTO picture (idAuthor, path, title, numero, idStudent)
                           VALUES (:idAuthor, :path, :title, :numero, :idStudent)")
                ->execute(array_intersect_key($args, array_flip(["idAuthor", "path", "title", "numero", "idStudent"])));
            return 0; // success
        } catch (\Exception $e) {
            return 1; // query error
        }
    } 

    public static function deletePicture(int $idPicture) { 
        try {
            if(!sel::existPicture($iPicture))
                return 2; // picture not exist
            Database::getInstance()
                ->prepare("DELETE FROM picture WHERE idPicture = :idPicture")
                ->execute(array("idPicture" => $idPicture));
            return 0;
        } catch (\Exception $e) {
            return 1; // query error
        }
    }

    public static function existPicture(int $idPicture) {
        $res = Database::getInstance()->prepare("SELECT * FROM picture WHERE idPicture = :idPicture");
        $res->execute(array("idPicture" => $idPicture));
        return $res->rowCount() !== 0;
    }

}