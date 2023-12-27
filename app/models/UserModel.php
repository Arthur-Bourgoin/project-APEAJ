<?php
namespace App\Models;
use Config\Database;
use App\Class\User;
use App\Models\CommentStudentModel;
use App\Class\Feedback;

class UserModel {

    public static function getUsers(int $idTraining) {
        try {
            $users = [];
            $res = Database::getInstance()->prepare("SELECT * FROM users WHERE idTraining = :id ORDER BY role DESC");
            $res->execute(array("id" => $idTraining));
            if($res->rowCount() === 0) {
                Feedback::setError("Aucun utilisateur n'est associé à cette formation.");
                return;
            }
            while($user = $res->fetch()) {
                $comments = CommentStudentModel::getComments($user->idUser);
                $users[] = new User($user, $comments);
            }
            return $users;
        } catch (\Exception $e) {
            Feedback::setError("Une erreur s'est produite lors du chargement de la page.");
        } finally {
            if(!empty($res))
                $res->closeCursor();
        }
    }

    public static function getStudents(int $idTraining) {
        try {
            $users = [];
            $res = Database::getInstance()->prepare("SELECT * FROM users WHERE idTraining = :id AND role = 'student'");
            $res->execute(array("id" => $idTraining));
            if($res->rowCount() === 0) {
                Feedback::setError("Aucun étudiant n'est associé à cette formation.");
                return;
            }
            while($user = $res->fetch()) {
                $comments = CommentStudentModel::getComments($user->idUser);
                $users[] = new User($user, $comments);
            }
            return $users;
        } catch (\Exception $e) {
            Feedback::setError("Une erreur s'est produite lors du chargement de la page.");
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
            Feedback::setError("Une erreur s'est produite lors du chargement de la page.");
        } finally {
            if(!empty($res))
                $res->closeCursor();
        }
    }

    public static function getUser(int $idUser) {
        try {
            $res = Database::getInstance()->prepare("SELECT * from users WHERE idUser = :id");
            $res->execute(array("id" => $idUser));
            if($res->rowCount() === 0) {
                Feedback::setError("Une erreur s'est produite lors du chargement de la page.");
                return;
            }
            $user = $res->fetch();
            $comments = CommentStudentModel::getComments($user->idUser);
            return new User($user, $comments);
        } catch (\Exception $e) {
            Feedback::setError("Une erreur s'est produite lors du chargement de la page.");
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

    public static function addUser(array $args) {
        try {
            if(!TrainingModel::existTraining($args["idTraining"])) {
                Feedback::setError("Impossible d'ajouter l'utilisateur, la formation associée n'existe pas.");
                return;
            }
            $keys = ["login", "lastName", "firstName", "picture", "typePwd", "pwd", "role", "idTraining"];
            $args["login"] = self::generateLogin($args["firstName"], $args["lastName"]);
            $args["pwd"] = password_hash($args["pwd"], PASSWORD_BCRYPT);
            Database::getInstance()
                ->prepare("INSERT INTO users (login, lastName, firstName, picture, typePwd, pwd, role, idTraining)
                           VALUES (:login, :lastName, :firstName, :picture, :typePwd, :pwd, :role, :idTraining)")
                ->execute(array_intersect_key($args, array_flip($keys)));
            Feedback::setSuccess("Ajout de l'utilisateur enregistré.");
        } catch (\Exception $e) {
            Feedback::setError("Une erreur s'est produite lors de l'ajout de l'utilisateur.");
        }
    }

    public static function updateUser(array $args) {
        try {
            if(!self::existUser($args["idUser"])) {
                Feedback::setError("Mise à jour impossible, l'utilisateur n'existe pas.");
                return;
            }
            $keys = ["login", "lastName", "firstName", "picture", "idUser"];
            $args["login"] = self::generateLogin($args["firstName"], $args["lastName"]);    
            //var_dump($_POST); exit();        
            Database::getInstance()
                ->prepare("UPDATE users 
                        SET login = :login,
                            lastName = :lastName,
                            firstName = :firstName,
                            picture = :picture
                        WHERE idUser = :idUser")
                ->execute(array_intersect_key($args, array_flip($keys)));
                Feedback::setSuccess("Mise à jour de l'utilisateur enregistrée.");
        } catch (\Exception $e) {
            Feedback::setError("Une erreur est survenue lors de la mise à jour de l'utilisateur.");
        }
    }

    public static function updateUserAndPwd(array $args) {
        try {
            if(!self::existUser($args["idUser"])) {
                Feedback::setError("Mise à jour impossible, l'utilisateur n'existe pas.");
                return;
            }
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
                Feedback::setSuccess("Mise à jour de l'utilisateur enregistrée.");
        } catch (\Exception $e) {
            Feedback::setError("Une erreur est survenue lors de la mise à jour de l'utilisateur.");
        }
    }

    /**
     * @todo export excel
     */
    public static function deleteUser(int $idUser) {
        return 0;
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
        if( ($num=$res->rowCount()) > 1)
            return strtolower($fName) . "." . strtolower($lName) . ($num+1);
        else
            return strtolower($fName) . "." . strtolower($lName);
    }

}