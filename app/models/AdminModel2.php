<?php


class AdminModel
{

    public static function getAllSessions(): array
    {
        $sessions = [
            ["session" => "Session 1"],
            ["session" => "Session 2"],
            ["session" => "Session 3"],
            ["session" => "Session 4"],
            ["session" => "Session 5"],
            ["session" => "Session 6"],
            ["session" => "Session 7"]
        ];
        return $sessions;
    }


    public static function getAllStudents(): array
    {
        $students = [
            ["ID" => 1, "nom" => "FREDERIC", "prenom" => "Mathieu", "picture" => "/assets/images/Utilisateurs/mathieu.png"],
            ["ID" => 2, "nom" => "CHARBONNIER", "prenom" => "Alban", "picture" => "/assets/images/Utilisateurs/alban.png"],
            ["ID" => 3, "nom" => "BALZAC", "prenom" => "Théo", "picture" => "/assets/images/Utilisateurs/theo.png"],
            ["ID" => 4, "nom" => "DELAUNEY", "prenom" => "Flora", "picture" => "/assets/images/Utilisateurs/flora.png"],
            ["ID" => 5, "nom" => "GARDET", "prenom" => "Fabien", "picture" => "/assets/images/Utilisateurs//fabien.png"],
            ["ID" => 6, "nom" => "DROZ", "prenom" => "Romane", "picture" => "/assets/images/Utilisateurs/romane.png"],
            ["ID" => 7, "nom" => "DUTOIT", "prenom" => "Bruno", "picture" => "/assets/images/Utilisateurs/bruno.png"],
            ["ID" => 8, "nom" => "LALANDE", "prenom" => "Gustave", "picture" => "/assets/images/Utilisateurs/gustave.png"]
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
}