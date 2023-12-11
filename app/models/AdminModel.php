<?php

namespace App\Models;

class AdminModel
{

    public static function getAllSessions(): array
    {
        $sessions = [
            ["ID" => 1, "name" => "Session 1", "Theme" => "Theme_test", "date_creation" => "2023-01-15T08:30", "date_fin" => "2023-01-30T17:00","desc"=> "test description"],
            ["ID" => 2, "name" => "Session 2", "Theme" => "Theme_test", "date_creation" => "2023-03-20T13:45", "date_fin" => "2023-04-05T16:30","desc"=> "test description"],
            ["ID" => 3, "name" => "Session 3", "Theme" => "Theme_test", "date_creation" => "2023-05-10T10:00", "date_fin" => "","desc"=> "test description"],
            ["ID" => 4, "name" => "Session 4", "Theme" => "Theme_test", "date_creation" => "2023-07-08T09:15", "date_fin" => "2023-07-25T14:00","desc"=> "test description"],
            ["ID" => 5, "name" => "Session 5", "Theme" => "Theme_test", "date_creation" => "2023-09-25T11:30", "date_fin" => "2023-10-10T18:00","desc"=> "test description"],
            ["ID" => 6, "name" => "Session 6", "Theme" => "Theme_test", "date_creation" => "2023-11-12T14:20", "date_fin" => "2023-11-30T12:30","desc"=> "test description"],
            ["ID" => 7, "name" => "Session 7", "Theme" => "Theme_test", "date_creation" => "2023-12-30T16:00", "date_fin" => "2024-01-15T15:30","desc"=> "test description"],
            ["ID" => 8, "name" => "Session 8", "Theme" => "Theme_test", "date_creation" => "2024-02-05T10:45", "date_fin" => "2024-01-15T15:30","desc"=> "test description"],
        ];
        return $sessions;
    }


    public static function getAllStudents(): array
    {
        $students = [
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
        $students = self::getAllStudents();
        foreach ($students as $student) {
            if ($student["ID"] == $studentId) {
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
    public static function getSessionById($id){
        $sessions=self::getAllSessions();
        foreach ($sessions as $session) {
            if ($session["ID"] == $id) {
                return $session;
            }
        }
    }
    public static function getFormbyID($formID){
        $form=[
            ["ID" => 1, "Etat" => "end","IDSession" =>"1","date_creation" => "2023-11-24","date_last_modif"=> "2023-11-28","note"=>1],
        ];
        return $form;
    }
    public static function getComsByFormID($formID){
        $coms=[
            ["ID"=>1,"Etat"=>"Hide","Text"=>"test1 Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut vel accumsan or" ],
            ["ID"=>2,"Etat"=>"Show","Text"=>"test2 ipsum dolor sit amet, consectetur adipiscing elit. Ut vel accumsan orci, et v" ]
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