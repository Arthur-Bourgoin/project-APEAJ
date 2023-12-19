<?php
namespace App\Models;
use Config\Database;
use App\Models\ {
    UserModel,
    SessionModel,
    CommentFormModel,
    PictureModel
};
use App\Class\Form;

class FormModel {

    public static function getFinishedForms(int $idStudent) {
        try {
            if(!UserModel::existUser($idStudent))
                return 2; // student not exist
            $forms = [];
            $res = Database::getInstance()->prepare("SELECT * FROM form WHERE idStudent = :id AND finish = true");
            $res->execute(array("id" => $idStudent));
            while ($form = $res->fetch()) {
                $session = SessionModel::getSession($form->idSession);
                $student = UserModel::getUser($form->idStudent);
                $forms[] = new Form($form, null, null, null, null, $session, $student, null);
            }
            return $forms;
        } catch (\Exception $e) {
            return 3; // query error
        } finally {
            if(!empty($res))
                $res->closeCursor();
        }
    }

    public static function getCurrentForm(int $idStudent) {
        try {
            if(!UserModel::existUser($idStudent))
                return 2; // student not exist
            $res = Database::getInstance()->prepare("SELECT * FROM form WHERE idStudent = :id AND finish = false");
            $res->execute(array("id" => $idStudent));
            $form = $res->fetch();
            if(!$form)
                return 1; // no current form
            $session = SessionModel::getSession($form->idSession);
            $student = UserModel::getUser($form->idStudent);
            return new Form($form, null, null, null, null, $session, $student, null);
        } catch (\Exception $e) {
            return 3; // query error
        } finally {
            if(!empty($res))
                $res->closeCursor();
        }
    }

    public static function getFormsBySession(int $idSession) {
        try {
            if(!SessionModel::existSession($idSession))
                return 2; // session not exist
            $forms = [];
            $res = Database::getInstance()->prepare("SELECT * FROM form WHERE idSession = :id");
            $res->execute(array("id" => $idSession));
            while ($form = $res->fetch())
                $forms[] = new Form($form, null, null, null, null, null, UserModel::getUser($form->idStudent), null);
            return $forms;
        } catch (\Exception $e) {
            return 1; // query error
        } finally {
            if(!empty($res))
                $res->closeCursor();
        }
    }

    public static function getFormsByTraining(int $idTraining) {
        try {
            if(!TrainingModel::existTraining($idTraining))
                return 2; // session not exist
            $forms = [];
            $res = Database::getInstance()->prepare("SELECT * FROM form, session WHERE form.idSession = session.idSession AND session.idTraining = :id");
            $res->execute(array("id" => $idTraining));
            while ($form = $res->fetch()) {
                $comments = CommentFormModel::getComments($form->numero, $form->idStudent);
                $forms[] = new Form($form, $comments, null, null, null, null, null, null);
            }
            return $forms;
        } catch (\Exception $e) {
            return 1; // query error
        } finally {
            if(!empty($res))
                $res->closeCursor();
        }
    }

    public static function getForm(int $numero, int $idStudent) {
        try {
            $res = Database::getInstance()->prepare("SELECT * FROM form WHERE numero = :numero AND idStudent = :idStudent");
            $res->execute(array("numero" => $numero, "idStudent" => $idStudent));
            if($res->rowCount() === 0) {
                return 1; // form not exist
            }
            $form = $res->fetch();
            $comments = CommentFormModel::getComments($numero, $idStudent);
            $pictures = PictureModel::getPictures($numero, $idStudent);
            $elements = DisplayElementModel::getDisplayElements($numero, $idStudent);
            $materials = MaterialModel::getMaterials($numero, $idStudent);
            $session = SessionModel::getSession($form->idSession);
            $student = UserModel::getUser($idStudent);
            $educator = UserModel::getUser($form->idEducator);
            if(!is_array($comments) || !is_array($pictures) || !is_array($elements) || !is_array($materials))
                return 2; // query error
            return new Form($form, $comments, $pictures, $elements, $materials, $session, $student, $educator);
        } catch (\Exception $e) {
            return 2; // query error
        } finally {
            if(!empty($res))
                $res->closeCursor();
        }
    }

    public static function finishForm(int $numero, int $idStudent) {
        try {
            if(!self::existForm($numero, $idStudent))
                return 2; // form not exist
            Database::getInstance()
                ->prepare("UPDATE form SET finish = true WHERE numero = :numero AND idStudent = :idStudent")
                ->execute(array("numero" => $numero, "idStudent" => $idStudent));
            return 0; // success
        } catch (\Exception $e) {
            return 1; // query error
        }
    }

    public static function existForm(int $numero, int $idStudent) {
        $res = Database::getInstance()->prepare("SELECT * FROM form WHERE numero = :numero AND idStudent = :id");
        $res->execute(array("id" => $idStudent, "numero" => $numero));
        return $res->rowCount() === 1;
    }

}