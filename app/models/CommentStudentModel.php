<?php
namespace App\Models;
use Config\Database;
use App\Models\UserModel;

class CommentStudentModel {

    public static function getComments(int $idStudent) {
        try {
            if(!UserModel::existUser($idStudent))
                return 1; // user not exist
            $res = Database::getInstance()->prepare("SELECT * FROM commentStudent WHERE idStudent = :id");
            $res->execute(array("id" => $idStudent));
            return $res->fetchAll();
        } catch (\Exception $e) {
            return 2; // query error
        } finally {
            if(!empty($res))
                $res->closeCursor();
        }
    }

    public static function addComment(array $args, int $idEducator) {
        try {
            if(!UserModel::existUser($args["idStudent"]))
                return 2; // student not exist
            $args["idEducator"] = $idEducator;
            $args["lastModif"] = date('Y-m-d H:i:s');
            Database::getInstance()
                ->prepare("INSERT INTO commentStudent (idStudent, idEducator, text, lastModif)
                           VALUES (:idStudent, :idEducator, :text, :lastModif)")
                ->execute(array_intersect_key($args, array_flip(["idStudent", "idEducator", "text", "lastModif"])));
            return 0; // success
        } catch (\Exception $e) {
            return 1; // query error
        }
    }   
    
    public static function updateComment(array $args, int $idEducator) {
        try {
            if(!self::existCommentStudent($args["idStudent"], $idEducator))
                return 2; // commentStudent not exist
            $args["idEducator"] = $idEducator;
            $args["lastModif"] = date('Y-m-d H:i:s');
            Database::getInstance()
                ->prepare("UPDATE commentStudent SET text = :text AND lastModif = :lastModif WHERE idStudent = :idStudent AND idEducator = :idEducator")
                ->execute(array_intersect_key($args, array_flip(["idStudent", "idEducator", "text", "lastModif"])));
            return 0; // success
        } catch (\Exception $e) {
            return 1; // query error
        }

    }

    public static function deleteComment(int $idEducator, int $idStudent) {
        try {
            if(!self::existCommentStudent($idStudent, $idEducator))
                return 2; // commentStudent not exist
            Database::getInstance()
                ->prepare("DELETE FROM commentStudent WHERE idEducator = :idEducator AND idStudent = :idStudent")
                ->execute(array("idEducator" => $idEducator, "idStudent" => $idStudent));
            return 0; // success
        } catch (\Exception $e) {
            return 1; // query error
        }
    }

    public static function existCommentStudent(int $idStudent, int $idEducator) {
        $res = Database::getInstance()->prepare("SELECT * FROM commentStudent WHERE idStudent = :idStudent AND idEducator = :idEducator");
        $res->execute(array("idStudent" => $idStudent, "idEducator" => $idEducator));
        return $res->rowCount() !== 0;
    }

}