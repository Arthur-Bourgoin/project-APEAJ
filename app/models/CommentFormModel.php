<?php
namespace App\Models;
use Config\Database;
use App\Models\FormModel;
use App\Models\UserModel;
use App\Class\CommentForm;

class CommentFormModel {
//verif info student
    public static function getComments(int $numero, int $idStudent) {
        try {
            $comments = [];
            if(!FormModel::existForm($numero, $idStudent))
                return 2; // form not exist
            $res = Database::getInstance()->prepare("SELECT * FROM commentForm WHERE numero = :numero AND idStudent = :id");
            $res->execute(array("id" => $idStudent, "numero" => $numero));
            while($comment = $res->fetch()) {
                $author = UserModel::getUser($comment->idAuthor);
                $comments[] = new CommentForm($comment, $author);
            }
            return $comments;
        } catch (\Exception $e) {
            return 1; // query error
        } finally {
            if(!empty($res))
                $res->closeCursor();
        }
    }

    public static function addComment(array $args, int $idAuthor) {
        try {
            if(!FormModel::existForm($args["numero"], $args["idStudent"]))
                return 2; // form not exist
            $keys = ["wording", "text", "audio", "admin", "lastModif", "numero", "idStudent", "idAuthor"];
            $args["idAuthor"] = $idAuthor;
            $args["lastModif"] = date('Y-m-d H:i:s');
            Database::getInstance()
                ->prepare("INSERT INTO commentForm (wording, text, audio, admin, lastModif, numero, , idStudent, idAuthor)
                           VALUES (:wording, :text, :audio, :admin, :lastModif, :numero, :idStudent, :idAuthor)")
                ->execute(array_intersect_key($args, array_flip($keys)));
            return 0;
        } catch (\Exception $e) {
            return 1; // query error
        }
    }

    public static function updateComment(array $args) {
        try {
            if(!self::existCommentForm($args["idCommentForm"]))
                return 1; // commentForm not exist
            $args["lastModif"] = date('Y-m-d H:i:s');
            Database::getInstance()
                ->prepare("UPDATE commentForm
                           SET wording = :wording,
                               text = :text,
                               audio = :audio,
                               admin = :admin,
                               lastModif = :lastModif
                           WHERE idCommentForm = :idCommentForm")
                ->execute(array_intersect_key($args, array_flip(["wording", "text", "audio", "admin", "lastModif", "idCommentForm"])));
            return 0;
        } catch (\Exception $e) {
            return 2; // query error
        }
    }

    public static function deleteComment(int $idCommentForm) {
        try {
            if(!self::existCommentForm($idCommentForm))
                return 2; // comment not exist
            Database::getInstance()
                ->prepare("DELETE FROM commentForm WHERE idCommentForm = :id")
                ->execute(array("id" => $idCommentForm));
            return 0;
        } catch (\Exception $e) {
            return 1; // query error
        }
    }

    public static function existCommentForm(int $idCommentForm) {
        $res = Database::getInstance()->prepare("SELECT * FROM commentForm WHERE idCommentForm = :id");
        $res->execute(array("id" => $idCommentForm));
        return $res->rowCount() !== 0;
    }

}