<?php

namespace App\Models;

class StudentModel
{
    public static function getFinishedSheets(): array
    {
        $FinishedSheets = [
            ["ID" => "1","state" => "end"],
            ["ID" => "2","state" => "end"],
            ["ID" => "3","state" => "end"],
            ["ID" => "4","state" => "end"],
            ["ID" => "5","state" => "end"],
            ["ID" => "6","state" => "end"]
        ];
        return $FinishedSheets;
    }

    public static function getCurrentSheet(): array
    {
        $currentSheet =
            ["ID" => "7","state" => "current"];
        return $currentSheet;
    }

    public static function verifpassword($login,$paswword) {
        $loginsMDP= [
            ["login"=>"m.frederic","mdp"=>"1234"],
            ["login"=>"ma.charbonnier","mdp"=>"1234"],
            ["login"=>"t.balzac","mdp"=>"1234"],
            ["login"=>"f.delaunay","mdp"=>"1234"],
            ["login"=>"f.gardet","mdp"=>"1234"],
            ["login"=>"r.droz","mdp"=>"1234"],
            ["login"=>"b.dutoit","mdp"=>"1234"],
            ["login"=>"g.lalande","mdp"=>"1234"],
            ["login"=>"c.mazet","mdp"=>"1234"]
        ];
        foreach ($loginsMDP as $loginMDP) {
            if ($loginMDP["login"] == $login) {
                if ($loginMDP["mdp"]== $password){
                    return true;
                }else{
                    return false;
                }
            }
        }
    }
}