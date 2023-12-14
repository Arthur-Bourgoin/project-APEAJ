<?php
namespace App\Models;
use Config\Database;

class UserModel {

    public static function getStudents(int $idTraining) {
        try {
            $res = Database::getInstance()->prepare("SELECT * FROM users WHERE idTraining = :id AND role = 'student'");
            $res->execute(array("id" => $idTraining));
            return $res->fetchAll();
        } catch (\Exception $e) {
            return 1; // query error
        } finally {
            if(!empty($res))
                $res->closeCursor();
        }
    }

    public static function getAdmins() {
        try {
            $res = Database::getInstance()->query("SELECT * FROM users WHERE role in ('educator-admin', 'educator', 'CIP', 'super-admin')");
            return $res->fetchAll();
        } catch (\Exception $e) {
            return 1; // query error
        } finally {
            if(!empty($res))
                $res->closeCursor();
        }
    }

    public static function getUser(int $idUser) {
        try {
            $res = Database::getInstance()->prepare("SELECT * from users WHERE idUser = :id");
            $res->execute(array("id" => $idUser));
            if($res->rowCount() === 0)
                return 2; // user not exist
            return $res->fetch();
        } catch (\Exception $e) {
            return 1; // query error
        } finally {
            if(!empty($res))
                $res->closeCursor();
        }
    }

    public static function updateUser(array $args) {
        try {
            if(!self::userExist($args["idUser"]))
                return 1; // user not exist
            $keys = ["login, lastName, firstName, picture, typePwd, pwd, role, idUser"];
            Database::getInstance()
                ->prepare("UPDATE users 
                        SET lastName = :lastName,
                            firstName = :firstName,
                            picture = :picture,
                            typePwd = :typePwd,
                            pwd = :pwd
                        WHERE idUser = :idUser")
                ->execute(array_intersect_key($args, array_flip($keys)));
                return 0; // success
        } catch (\Exception $e) {
            return 2; // query error
        }
    }

    public static function addUser(array $args, int $idTraining) {
        try {
            $keys = ["login", "lastName", "firstName", "picture", "typePwd", "pwd", "role", "idTraining"];
            $args["login"] = self::generateLogin($args["firstName"], $args["lastName"]);
            $args["idTraining"] = $idTraining;
            Database::getInstance()
                ->prepare("INSERT INTO users (login, lastName, firstName, picture, typePwd, pwd, role, idTraining)
                           VALUES (:login, :lastName, :firstName, :picture, :typePwd, :pwd, :role, :idTraining)")
                ->execute(array_intersect_key($args, array_flip($keys)));
            return 0;
        } catch (\Exception $e) {
            return 1; // query error
        }
    }

    public static function userExist(int $idUser) {
        $res = Database::getInstance()->prepare("SELECT * FROM users WHERE idUser = :id");
        $res->execute(array("id" => $idUser));
        return $res->rowCount() === 1;
    }

    private static function generateLogin(string $fName, string $lName) {
        $res = Database::getInstance()->prepare("SELECT * FROM users WHERE lastName = :lName AND firstName = :fName");
        $res->execute(array("lName" => $lName, "fName" => $fName));
        if( ($num=$res->rowCount()) !== 0)
            return strtolower($fName) . "." . strtolower($lName) . $num;
        else
            return strtolower($fName) . "." . strtolower($lName);
    }

}