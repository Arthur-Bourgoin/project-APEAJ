<?php

namespace App\Models;
use App\Classes\User;

class AdminModel
{

    public static function getAllSessions(): array
    {
        $sessions = [
            ["session" => "Session 1", "ID" => 1],
            ["session" => "Session 2", "ID" => 2],
            ["session" => "Session 3", "ID" => 3],
            ["session" => "Session 4", "ID" => 4],
            ["session" => "Session 5", "ID" => 5],
            ["session" => "Session 6", "ID" => 6],
            ["session" => "Session 7", "ID" => 7]
        ];
        return $sessions;
    }


    public static function getAllStudents(): array
    {
        $studentsData = [
            ["ID" => 1, "nom" => "FREDERIC", "prenom" => "Mathieu", "picture" => "/assets/images/Utilisateurs/mathieu.png", "login" => "m.frederic","typemdp" => "code"],
            ["ID" => 2, "nom" => "CHARBONNIER", "prenom" => "Alban", "picture" => "/assets/images/Utilisateurs/alban.png", "login" => "a.charbonnier","typemdp" => "texte"],
            ["ID" => 3, "nom" => "BALZAC", "prenom" => "Theo", "picture" => "/assets/images/Utilisateurs/theo.png", "login" => "t.balzac","typemdp" => "code"],
            ["ID" => 4, "nom" => "DELAUNEY", "prenom" => "Flora", "picture" => "/assets/images/Utilisateurs/flora.png", "login" => "f.delaunay","typemdp" => "texte"],
            ["ID" => 5, "nom" => "GARDET", "prenom" => "Fabien", "picture" => "/assets/images/Utilisateurs//fabien.png", "login" => "f.gardet","typemdp" => "texte"],
            ["ID" => 6, "nom" => "DROZ", "prenom" => "Romane", "picture" => "/assets/images/Utilisateurs/romane.png", "login" => "f.gardet","typemdp" => "texte"],
            ["ID" => 7, "nom" => "DUTOIT", "prenom" => "Bruno", "picture" => "/assets/images/Utilisateurs/bruno.png", "login" => "b.dutoit","typemdp" => "code"],
            ["ID" => 8, "nom" => "LALANDE", "prenom" => "Gustave", "picture" => "/assets/images/Utilisateurs/gustave.png", "login" => "g.lalande","typemdp" => "texte"],
            ["ID" => 9, "nom" => "MAZET", "prenom" => "Coralie","picture"=>"/assets/images/Utilisateurs/coralie.png","login"=>"c.mazet","typemdp"=>"texte"]
        ];
        $students = [];
        foreach ($studentsData as $student) {
            $studentObj = new User(
                $student["ID"],
                $student["login"],
                $student["nom"],
                $student["prenom"],
                $student["picture"],
                $student["typemdp"],
                '', // Pour le mot de passe, ici vide car non fourni dans les données initiales
                ''   // Pour le rôle, ici vide car non fourni dans les données initiales
            );
            $students[] = $studentObj;
        }
    
        return $students;
    }
    public static function getFormationAdmin(int $id): array
    {
        $formation = [
            ["Formation" => "Plomberie"]
        ];
        return $formation;
    }
    public static function getStudentById($studentId)
{
    $students = AdminModel::getAllStudents();
    foreach ($students as $student) {
        if ($student->getId() == $studentId) { 
            return $student;
        }
    }
    return null;
}

    public static function getFichesFiniesByStudentId($studentId)
    {

        $fichesF = [
            ["ID" => 1, "Etat" => "end", "NomEtu" => "FREDERIC", "PrenomEtu" => "Mathieu","IDstu" =>1,"note"=>2],
            ["ID" => 2, "Etat" => "end", "NomEtu" => "CHARBONNIER", "PrenomEtu" => "Alban","IDstu" =>2,"note"=> 4],
            ["ID" => 3, "Etat" => "end", "NomEtu" => "BALZAC", "PrenomEtu" => "Theo","IDstu" =>3,"note"=>null],
            ["ID" => 4, "Etat" => "end", "NomEtu" => "DELAUNEY", "PrenomEtu" => "Flora","IDstu" =>4,"note"=> 1],
        ];
        return $fichesF;
    }
    public static function getFichesNonFiniesByStudentId($studentId)
    {

        $fichesnF = [
            ["ID" => 5, "Etat" => "end", "NomEtu" => "GARDET", "PrenomEtu" => "Fabien","IDstu" =>5,"note"=> 3]
        ];
        return $fichesnF;
    }
    public static function getStudentsBySession($sessionId)
    {
        $students = [
            ["ID" => 1, "nom" => "FREDERIC", "prenom" => "Mathieu", "picture" => "/assets/images/Utilisateurs/mathieu.png"],
            ["ID" => 2, "nom" => "CHARBONNIER", "prenom" => "Alban", "picture" => "/assets/images/Utilisateurs/alban.png"],
            ["ID" => 3, "nom" => "BALZAC", "prenom" => "Théo", "picture" => "/assets/images/Utilisateurs/theo.png"],
            ["ID" => 4, "nom" => "DELAUNEY", "prenom" => "Flora", "picture" => "/assets/images/Utilisateurs/flora.png"],
            ["ID" => 5, "nom" => "GARDET", "prenom" => "Fabien", "picture" => "/assets/images/Utilisateurs//fabien.png"],
        ];
        return $students;
    }
    public static function getFichesBySession($sessionId)
    {
        $fiches = [
            ["ID" => 1, "Etat" => "end", "NomEtu" => "FREDERIC", "PrenomEtu" => "Mathieu","IDstu" =>1,"note"=>2],
            ["ID" => 2, "Etat" => "end", "NomEtu" => "CHARBONNIER", "PrenomEtu" => "Alban","IDstu" =>2,"note"=> 4],
            ["ID" => 3, "Etat" => "end", "NomEtu" => "BALZAC", "PrenomEtu" => "Theo","IDstu" =>3,"note"=>null],
            ["ID" => 4, "Etat" => "end", "NomEtu" => "DELAUNEY", "PrenomEtu" => "Flora","IDstu" =>4,"note"=> 1],
            ["ID" => 5, "Etat" => "end", "NomEtu" => "GARDET", "PrenomEtu" => "Fabien","IDstu" =>5,"note"=> 3]
        ];
        return $fiches;
    }
    public static function getDescription($sessionId)
    {
        $description = [
            ["ID" => 1, "Desc" => "Ceci est la description de la session sélectionnée", "Nom" => "Session n°1"]
        ];
        return $description;

    }
    public static function getFormbyID($formID){
        $form=[
            ["ID" => 1, "Etat" => "end","IDSession" =>"1","date_creation" => "2023-11-24","date_last_modif"=> "2023-11-28","note"=>1],
        ];
        return $form;
    }
    public static function getComsByFormID($formID){
        $coms=[
            ["ID"=>1,"Etat"=>"Hide","Text"=>"test 1 " ],
            ["ID"=>2,"Etat"=>"Show","Text"=>"test 2" ]
        ];
        return $coms;
    }
    public static function getPicturesByFormID($formId){
        $pictures=[
            ["ID"=> 1,"path"=> "Mettre le path","name"=>"picture 1"],
            ["ID"=> 2,"path"=> "Mettre le path","name"=>"picture 2"],
            ["ID"=> 3,"path"=> "Mettre le path","name"=>"picture 3"],
            ["ID"=> 4,"path"=> "Mettre le path","name"=>"picture 4"],
        ];
        return $pictures;
    }
}