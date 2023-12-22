<?php
namespace App\Models;
use Config\Database;
use App\Class\User;
use App\Models\CommentStudentModel;

class UserModel {

    public static function getUsers(int $idTraining) {
        try {
            $users = [];
            $res = Database::getInstance()->prepare("SELECT * FROM users WHERE idTraining = :id ORDER BY role DESC");
            $res->execute(array("id" => $idTraining));
            while($user = $res->fetch()) {
                $comments = CommentStudentModel::getComments($user->idUser);
                if(!is_array($comments))
                    return 14; // Error on CommentStudensModel::getComments() method
                $users[] = new User($user, $comments);
            }
            return $users;
        } catch (\Exception $e) {
            return 1; // query error
        } finally {
            if(!empty($res))
                $res->closeCursor();
        }
    }

    public static function getStudents(int $idTraining) {
        try {
            if(!TrainingModel::existTraining($idTraining))
                return 47; // training not exist
            $users = [];
            $res = Database::getInstance()->prepare("SELECT * FROM users WHERE idTraining = :id AND role = 'student'");
            $res->execute(array("id" => $idTraining));
            while($user = $res->fetch()) {
                $comments = CommentStudentModel::getComments($user->idUser);
                if(!is_array($comments))
                    return 14; // Error on CommentStudensModel::getComments() method
                $users[] = new User($user, $comments);
            }
            return $users;
        } catch (\Exception $e) {
            return 1; // query error
        } finally {
            if(!empty($res))
                $res->closeCursor();
        }
    }

    public static function getAdmins() {
        try {
            $admins = [];
            $res = Database::getInstance()->query("SELECT * FROM users WHERE role in ('educator-admin', 'educator', 'CIP','super-admin')");
            while($admin = $res->fetch()) {
                $admins[] = new User($admin, null);
            }
            return $admins;
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
            $user = $res->fetch();
            $comments = CommentStudentModel::getComments($user->idUser);
            if(!is_array($comments))
                return 73; // Error on CommentStudensModel::getComments() method
            return new User($user, $comments);
        } catch (\Exception $e) {
            return 1; // query error
        } finally {
            if(!empty($res))
                $res->closeCursor();
        }
    }

    public static function getUserByLogin(string $login) {
        try {
            $res = Database::getInstance()->prepare("SELECT * FROM users WHERE login = :login");
            $res->execute(array("login" => $login));
            if(!$user = $res->fetch())
                return 2; // user not exist
            else
                return $user;
        } catch (\Exception $e) {
            return 3; // query error
        } finally {
            if(!empty($res))
                $res->closeCursor();
        }
    }

    public static function addUser(array $args, int $idTraining) {
        try {
            $keys = ["login", "lastName", "firstName", "picture", "typePwd", "pwd", "role", "idTraining"];
            $args["login"] = self::generateLogin($args["firstName"], $args["lastName"]);
            $args["idTraining"] = $idTraining;
            $args["pwd"] = password_hash($args["pwd"], PASSWORD_BCRYPT);
            Database::getInstance()
                ->prepare("INSERT INTO users (login, lastName, firstName, picture, typePwd, pwd, role, idTraining)
                           VALUES (:login, :lastName, :firstName, :picture, :typePwd, :pwd, :role, :idTraining)")
                ->execute(array_intersect_key($args, array_flip($keys)));
            return 0;
        } catch (\Exception $e) {
            return 101; // query error
        }
    }

    public static function updateUser(array $args) {
        try {
            if(!self::existUser($args["idUser"]))
                return 401; // user not exist
            $keys = ["login", "lastName", "firstName", "picture", "idUser"];
            $args["login"] = self::generateLogin($args["firstName"], $args["lastName"]);
            
            Database::getInstance()
                ->prepare("UPDATE users 
                        SET login = :login,
                            lastName = :lastName,
                            firstName = :firstName,
                            picture = :picture
                        WHERE idUser = :idUser")
                ->execute(array_intersect_key($args, array_flip($keys)));
                return 0; // success
        } catch (\Exception $e) {
            return 201; // query error
        }
    }

    public static function updateUserAndPwd(array $args) {
        try {
            if(!self::existUser($args["idUser"]))
                return 401; // user not exist
            $keys = ["login", "lastName", "firstName", "picture", "typePwd", "pwd", "idUser"];
            $args["login"] = self::generateLogin($args["firstName"], $args["lastName"]);
            $args["pwd"] = password_hash($args["pwd"], PASSWORD_BCRYPT);
            Database::getInstance()
                ->prepare("UPDATE users 
                        SET login = :login,
                            lastName = :lastName,
                            firstName = :firstName,
                            picture = :picture,
                            typePwd = :typePwd,
                            pwd = :pwd
                        WHERE idUser = :idUser")
                ->execute(array_intersect_key($args, array_flip($keys)));
                return 0; // success
        } catch (\Exception $e) {
            return 201; // query error
        }
    }

    /**
     * @todo export excel
     */
    public static function deleteUser(int $idUser) {
        return 0; // query error
    }

    public static function existUser(int $idUser) {
        $res = Database::getInstance()->prepare("SELECT * FROM users WHERE idUser = :id");
        $res->execute(array("id" => $idUser));
        return $res->rowCount() === 1;
    }

    /**
     * Undocumented function
     * problem both login
     * @param string $fName
     * @param string $lName
     * @return void
     */
    private static function generateLogin(string $fName, string $lName) {
        $res = Database::getInstance()->prepare("SELECT * FROM users WHERE lastName = :lName AND firstName = :fName");
        $res->execute(array("lName" => $lName, "fName" => $fName));
        if( ($num=$res->rowCount()) !== 0)
            return strtolower($fName) . "." . strtolower($lName) . $num;
        else
            return strtolower($fName) . "." . strtolower($lName);
    }

}