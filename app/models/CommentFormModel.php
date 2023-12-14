<?php
namespace App\Models;
use Config\Database;
use App\Models\FormModel;

class CommentFormModel {

    public static function getComments(int $numero, int $idStudent) {
        try {
            if(!FormModel::existForm($numero, $idStudent))
                return 2; // form not exist
            $res = Database::getInstance()->prepare("SELECT * FROM commentForm WHERE numero = :numero AND idStudent = :id");
            $res->execute(array("id" => $idStudent, "numero" => $numero));
            return $res->fetchAll();
        } catch (\Exception $e) {
            return 1; // query error
        } finally {
            if(!empty($res))
                $res->closeCursor();
        }
    }

    public static function addComment(array $args) {
        try {
            Database::getInstance()
                ->prepare("INSERT INTO commentForm (wording, text, admin)
                           VALUES (:wording, :text, :admin)")
                ->execute(array_intersect_key($args, array_flip(["wording", "text", "admin"])));
            return 0;
        } catch (\Exception $e) {
            return 1; // query error
        }
    }

}