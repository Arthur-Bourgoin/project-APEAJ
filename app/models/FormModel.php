<?php
namespace App\Models;
use Config\Database;
use App\Models\ {
    UserModel,
    SessionModel,
    CommentFormModel,
    PictureModel
};
use App\Class\ {
    Form,
    Feedback
};

class FormModel {

    public static function getForms(int $idStudent){
        try {
            $forms = [];
            $res = Database::getInstance()->prepare("SELECT * FROM form WHERE idStudent = :id");
            $res->execute(array("id" => $idStudent));
            if($res->rowCount() === 0) {
                Feedback::setError("Aucune fiche n'est associée à cet étudiant.");
                return;
            }
            while ($form = $res->fetch()) {
                $comments = CommentFormModel::getComments($form->numero, $form->idStudent);
                $forms[] = new Form($form, $comments, null, null, null, null, null, null, true);
            }
            return $forms;
        } catch (\Exception $e) {
            Feedback::setError("Une erreur s'est produite lors du chargement de la page.");
        } finally {
            if(!empty($res))
                $res->closeCursor();
        }
    }

    public static function getFinishedForms(int $idStudent) {
        try {
            $forms = [];
            $res = Database::getInstance()->prepare("SELECT * FROM form WHERE idStudent = :id AND finish = true");
            $res->execute(array("id" => $idStudent));
            if($res->rowCount() === 0) {
                Feedback::setError("Aucune fiche finie n'est associée à cet étudiant.");
                return;
            }
            while ($form = $res->fetch()) {
                $session = SessionModel::getSession($form->idSession);
                $student = UserModel::getUser($form->idStudent);
                $forms[] = new Form($form, null, null, null, null, $session, $student, null, null);
            }
            return $forms;
        } catch (\Exception $e) {
            Feedback::setError("Une erreur s'est produite lors du chargement de la page.");
        } finally {
            if(!empty($res))
                $res->closeCursor();
        }
    }

    public static function getCurrentForm(int $idStudent) {
        try {
            $res = Database::getInstance()->prepare("SELECT * FROM form WHERE idStudent = :id AND finish = false");
            $res->execute(array("id" => $idStudent));
            if($res->rowCount() === 0) {
                Feedback::setError("Aucune fiche en cours n'est associée à cet étudiant.");
                return;
            }
            $form = $res->fetch();
            $session = SessionModel::getSession($form->idSession);
            $student = UserModel::getUser($form->idStudent);
            return new Form($form, null, null, null, null, $session, $student, null, null);
        } catch (\Exception $e) {
            Feedback::setError("Une erreur s'est produite lors du chargement de la page.");
        } finally {
            if(!empty($res))
                $res->closeCursor();
        }
    }

    public static function getFormsBySession(int $idSession) {
        try {
            $forms = [];
            $res = Database::getInstance()->prepare("SELECT * FROM form WHERE idSession = :id");
            $res->execute(array("id" => $idSession));
            if($res->rowCount() === 0) {
                Feedback::setError("Aucune fiche n'est associée à cette session.");
                return;
            }
            while ($form = $res->fetch())
                $forms[] = new Form($form, null, null, null, null, null, UserModel::getUser($form->idStudent), null, null);
            return $forms;
        } catch (\Exception $e) {
            Feedback::setError("Une erreur s'est produite lors du chargement de la page.");
        } finally {
            if(!empty($res))
                $res->closeCursor();
        }
    }

    public static function getFormsByTraining(int $idTraining) {
        try {
            $forms = [];
            $res = Database::getInstance()->prepare("SELECT * FROM form, session WHERE form.idSession = session.idSession AND session.idTraining = :id");
            $res->execute(array("id" => $idTraining));
            if($res->rowCount() === 0) {
                Feedback::setError("Aucune fiche n'est associée à cette formation.");
                return;
            }
            while ($form = $res->fetch()) {
                $comments = CommentFormModel::getComments($form->numero, $form->idStudent);
                $forms[] = new Form($form, $comments, null, null, null, null, null, null);
            }
            return $forms;
        } catch (\Exception $e) {
            Feedback::setError("Une erreur s'est produite lors du chargement de la page.");
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
                Feedback::setError("Erreur, la fiche demandée n'existe pas.");
                return;
            }
            $form = $res->fetch();
            $comments = CommentFormModel::getComments($numero, $idStudent);
            $pictures = PictureModel::getPictures($numero, $idStudent);
            $elements = DisplayElementModel::getDisplayElements($numero, $idStudent);
            $materials = MaterialModel::getMaterials($numero, $idStudent);
            $session = SessionModel::getSession($form->idSession);
            $student = UserModel::getUser($idStudent);
            $educator = UserModel::getUser($form->idEducator);
            if(!is_array($comments) || !is_array($pictures) || !is_array($elements) || !is_array($materials)) {
                Feedback::setError("Une erreur s'est produite lors du chargement de la page.");
                return;
            }
            return new Form($form, $comments, $pictures, $elements, $materials, $session, $student, $educator,null);
        } catch (\Exception $e) {
            Feedback::setError("Une erreur s'est produite lors du chargement de la page.");
        } finally {
            if(!empty($res))
                $res->closeCursor();
        }
    }

    public static function finishForm(int $numero, int $idStudent) {
        try {
            if(!self::existForm($numero, $idStudent)) {
                Feedback::setError("Mise à jour impossible, la fiche n'existe pas.");
                return;
            }
            Database::getInstance()
                ->prepare("UPDATE form SET finish = true WHERE numero = :numero AND idStudent = :idStudent")
                ->execute(array("numero" => $numero, "idStudent" => $idStudent));
            Feedback::setSuccess("Mise à jour de la fiche enregistrée.");
        } catch (\Exception $e) {
            Feedback::setError("Une erreur s'est produite lors de la mise à jour de la fiche.");
        }
    }

    public static function avgLevelElements(int $numero, int $idStudent) {
        try {
            $res = Database::getInstance()->prepare("SELECT avg(level) as avg FROM display WHERE numero = :numero AND idStudent = :idStudent");
            $res->execute(array("numero" => $numero, "idStudent" => $idStudent));
            return $res->fetch()->avg;
        } catch(\Exception $e) {
            Feedback::setError("Une erreur s'est produite lors du chargement de la page.");
        }
    }

    public static function avgNoteComments(int $numero, int $idStudent) {
        try {
            $res = Database::getInstance()->prepare("SELECT avg(note) as avg FROM commentForm WHERE numero = :numero AND idStudent = :idStudent");
            $res->execute(array("numero" => $numero, "idStudent" => $idStudent));
            return $res->fetch()->avg;
        } catch(\Exception $e) {
            Feedback::setError("Une erreur s'est produite lors du chargement de la page.");
        }
    }

    public static function existForm(int $numero, int $idStudent) {
        $res = Database::getInstance()->prepare("SELECT * FROM form WHERE numero = :numero AND idStudent = :id");
        $res->execute(array("id" => $idStudent, "numero" => $numero));
        return $res->rowCount() === 1;
    }

}