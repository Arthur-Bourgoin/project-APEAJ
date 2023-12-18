<?php
namespace App\Models;
use Config\Database;
use App\Class\Training;
use App\Class\ExportExcel;

class TrainingModel {

    public static function getTrainings() {
        try {
            $trainings = [];
            $res = Database::getInstance()->query("SELECT * FROM training");
            while($training = $res->fetch()) {
                $trainings[] = new Training($training);
            }
            return $trainings;
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

    public static function updateTraining(array $args) {
        try {
            if(!self::existTraining($args["idTraining"]))
                return 14; // training not exist
            Database::getInstance()
                ->prepare("UPDATE training
                           SET wording = :wording, description = :description, qualifLevel = :qualifLevel
                           WHERE idTraining = :idTraining")
                ->execute(array_intersect_key($args, array_flip(["wording", "description", "qualifLevel", "idTraining"])));
            return 0;
        } catch (\Exception $e) {
            return 3; // query error
        }
    }

    public static function deleteTraining(int $idTraining) {
        try {
            if(!self::existTraining($idTraining))
                return 47; // training not exist
            Database::getInstance()
                ->prepare("DELETE FROM training WHERE idTraining = :id")
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