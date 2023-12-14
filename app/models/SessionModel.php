<?php
namespace App\Models;
use Config\Database;

class SessionModel {

    public static function getSessions(int $idTraining) {
        try {
            $res = Database::getInstance()->prepare("SELECT * FROM session WHERE idTraining = :id");
            $res->execute(array("id" => $idTraining));
            return $res->fetchAll();
        } catch (\Exception $e) {
            return 1; // query error
        } finally {
            if(!empty($res))
                $res->closeCursor();
        }
    }

    public static function getSession(int $idSession) {
        try {
            if(!self::sessionExist($idSession))
                return 1; // session not exist
            $res = Database::getInstance()->prepare("SELECT * FROM session WHERE idSession = :id");
            $res->execute(array("id" => $idSession));
            return $res->fetch();
        } catch (\Exception $e) {
            return 2; // query error
        } finally {
            if(!empty($res))
                $res->closeCursor();
        }
    }

    public static function addSession(array $args) {
        try {
            Database::getInstance()
                ->prepare("INSERT INTO session (wording, theme, description, timeBegin) 
                           VALUES (:wording, :theme, :description, :timeBegin)")
                ->execute(array_intersect_key($args, array_flip(["wording", "theme", "description", "timeBegin"])));
            return 0; //success
        } catch (\Exception $e) {
            return 1; // query error;
        }
    }

    public static function updateSession(array $args) {
        try {
            if(!self::existSession($args["idSession"]))
                return 2; // session not exist
            Database::getInstance()
                ->prepare("UPDATE session
                           SET wording = :wording,
                               theme = :theme,
                               description = :description,
                               timeBegin = :timeBegin,
                               timeEnd = :timeEnd
                           WHERE idSession = :idSession")
                ->execute(array_intersect_key($args, array_flip(["wording", "theme", "description", "timeBegin", "timeEnd", "idSession"])));
            return 0;
        } catch (\Exception $e) {
            return 1; // query error
        }
    }

    public static function closeSession(int $idSession) {
        try {
            if(!self::existSession($idSession))
                return 2; // session not exist
            Database::getInstance()
                ->prepare("UPDATE session SET timeEnd = :timeEnd WHERE idSession = :id")
                ->execute(array("id" => $idSession, "timeEnd" => date('Y-m-d H:i:s')));
            return 0;
        } catch (\Exception $e) {
            return 1; // query error
        }
    }
    

    public static function sessionExist(int $idSession) {
        $res = Database::getInstance()->prepare("SELECT * FROM session WHERE idSession = :id");
        $res->execute(array("id" => $idSession));
        return $res->rowCount() === 1;
    }

}