<?php
namespace App\Models;
use Config\Database;
use App\Class\Session;
use App\Models\TrainingModel;
use App\Class\Feedback;

class SessionModel {

    public static function getSessions(int $idTraining) {
        try {
            $sessions = [];
            $res = Database::getInstance()->prepare("SELECT * FROM session WHERE idTraining = :id");
            $res->execute(array("id" => $idTraining));
            while($session = $res->fetch()) {
                $sessions[] = new Session($session);
            }
            return $sessions;
        } catch (\Exception $e) {
            Feedback::setError("Une erreur s'est produite lors du chargement de la page.");
        } finally {
            if(!empty($res))
                $res->closeCursor();
        }
    }

    public static function getSession(int $idSession) {
        try {
            $res = Database::getInstance()->prepare("SELECT * FROM session WHERE idSession = :id");
            $res->execute(array("id" => $idSession));
            if($res->rowCount() === 0) {
                Feedback::setError("Une erreur s'est produite lors du chargement de la page.");
                return;
            }
            return $res->fetch();
        } catch (\Exception $e) {
            Feedback::setError("Une erreur s'est produite lors du chargement de la page.");
        } finally {
            if(!empty($res))
                $res->closeCursor();
        }
    }

    public static function addSession(array $args) {
        try {
            if(!TrainingModel::existTraining($args["idTraining"])) {
                Feedback::setError("Impossible d'ajouter la session, la formation associée n'existe pas.");
                return;
            }
            Database::getInstance()
                ->prepare("INSERT INTO session (wording, theme, description, timeBegin, idTraining) 
                           VALUES (:wording, :theme, :description, :timeBegin, :idTraining)")
                ->execute(array_intersect_key($args, array_flip(["wording", "theme", "description", "timeBegin", "idTraining"])));
            Feedback::setSuccess("Ajout de la session enregistré.");
        } catch (\Exception $e) {
            Feedback::setError("Une erreur s'est produite lors de l'ajout de la session.");
        }
    }

    public static function updateSession(array $args) {
        try {
            if(!self::existSession($args["idSession"])) {
                Feedback::setError("Mise à jour impossible, la session n'existe pas.");
                return;
            }
            Database::getInstance()
                ->prepare("UPDATE session
                           SET wording = :wording,
                               theme = :theme,
                               description = :description,
                               timeBegin = :timeBegin
                           WHERE idSession = :idSession")
                ->execute(array_intersect_key($args, array_flip(["wording", "theme", "description", "timeBegin", "idSession"])));
            Feedback::setSuccess("Modification de la session enregistrée.");
        } catch (\Exception $e) {
            Feedback::setError("Une erreur s'est produite lors de la modification de la session.");
        }
    }

    public static function deleteSession(int $idSession) {
        try {
            if(!self::existSession($idSession)) {
                Feedback::setError("Suppression impossible, la session n'existe pas.");
                return;
            }
            Database::getInstance()
                ->prepare("DELETE FROM session WHERE idSession = :id")
                ->execute(array("id" => $idSession));
            Feedback::setSuccess("Suppression de la session enregistrée.");
        } catch (\Exception $e) {
            Feedback::setError("Une erreur s'est produite lors de la suppression de la session.");
        }
    }

    public static function closeSession(int $idSession) {
        try {
            if(!self::existSession($idSession)) {
                Feedback::setError("Erreur, la session n'existe pas.");
                return;
            }
            Database::getInstance()
                ->prepare("UPDATE session SET timeEnd = :timeEnd WHERE idSession = :id")
                ->execute(array("id" => $idSession, "timeEnd" => date('Y-m-d H:i:s')));
            Feedback::setSuccess("Fin de la session enregistrée à " . date('Y-m-d H:i:s')); //format
        } catch (\Exception $e) {
            Feedback::setError("Une erreur s'est produite lors de la fermeture de la session.");
        }
    }
    

    public static function existSession(int $idSession) {
        $res = Database::getInstance()->prepare("SELECT * FROM session WHERE idSession = :id");
        $res->execute(array("id" => $idSession));
        return $res->rowCount() === 1;
    }

}