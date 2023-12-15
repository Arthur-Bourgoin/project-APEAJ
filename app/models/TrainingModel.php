<?php
namespace App\Models;

class TrainingModel {

    public static function getTrainings() {
        try {
            $res = Database::getInstance()->query("SELECT * FROM training");
            return $res->fetchAll();
        } catch (\Exception $e) {
            return 1; // query error
        } finally {
            if(!empty($res))
                $res->closeCursor();
        }
    }

    public static function getTraining(int $idTraining) {
        try {
            $res = Database::getInstance()->prepare("SELECT * FROM training WHERE idTraining = :id");
            $res->execute(array("id" => $idTraining));
            if($res->rowCount() === 0)
                return 2; // training not exist
            return $res->fetch();
        } catch (\Exception $e) {
            return 7; // query error
        } finally {
            if(!empty($res))
                $res->closeCursor();
        }
    }

    public static function addTraining(array $args) {
        try {
            Database::getInstance()
                ->prepare("INSERT INTO training (wording, description, qualifLevel)
                        VALUES (:wording, :description, :qualifLevel)")
                ->execute(array_intersect_key($args, array_flip(["wording", "description", "qualifLevel"])));
            return 0;
        } catch (\Exception $e) {
            return 3; // query error
        }
    }

    public static function deleteTraining(int $idTraining) {
        try {
            Database::getInstance()
                ->prepare("DELETE FROM session WHERE idSession = :id")
                ->execute(array("id" => $idTraining));
            return 0;
        } catch (\Exception $e) {
            return 4; // query error
        }
    }

    public static function existTraining(int $idTraining) {
        $res = Database::getInstance()->prepare("SELECT * FROM training WHERE idTraining = :id");
        $res->execute(array("id" => $idTraining));
        return $res->rowCount() === 1;
    }

}