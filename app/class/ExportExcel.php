<?php

namespace App\Class;
use PhpOffice\PhpSpreadsheet\Spreadsheet;
use PhpOffice\PhpSpreadsheet\Writer\Xlsx;
use PhpOffice\PhpSpreadsheet\Style\{
    Alignment,
    Border,
    Fill
};
use App\Models\{
    UserModel,
    SessionModel,
    FormModel
};

class ExportExcel {

    private $spreadsheet;
    private $activeSheet;
    private $excel_writer;
    private $line;
    private $colorsTitle = ["FFA9FF5B", "FFC0EE3A", "FF548DF1", "FFCD62FF", "FFE84DC1", "FFEC3333", "FFE5C639", "FFE9B92F", "FF42DB8B", "FF9C55F9"];
    private $colorsSubTitle = ["FFBFFF86", "FFCDF557", "FF7AAAFF", "FFCB8CE9", "FFFC7FDC", "FFF15757", "FFF1D761", "FFF3C951", "FF65EAA5", "FFA578DF"];
    private $colorsContent = ["FFD2FFA9", "FFDCFC7C", "FFAFCCFF", "FFEABFFF", "FFF1A7DE", "FFFF8888", "FFF9E99D", "FFFADB83", "FF96F0C1", "FFCEB5EF"];


    private $nbColors = 10;
    const STYLE_ARRAY = [
        'font' => [
            'bold' => true,
        ],
        'alignment' => [
            'horizontal' => Alignment::HORIZONTAL_CENTER,
            'vertical' => Alignment::VERTICAL_CENTER,
        ],
    ];


    public function __construct() {
        $this->spreadsheet = new Spreadsheet();
        $this->excel_writer = new Xlsx($this->spreadsheet);
        $this->spreadsheet->setActiveSheetIndex(0);
        $this->activeSheet = $this->spreadsheet->getActiveSheet();
        $this->line=1;
    }

    public function exportTraining(int $idTraining) {
        $columnWidths = ['A' => 10, 'B' => 25, 'C' => 15, 'D' => 20, 'E' => 20, 'F' => 20, 'G' => 15, 'H' => 15, 'I' => 20, 'J' => 15, 'K' => 15, 'L' => 17, 'M' => 15, 'N' => 20, 'O' => 20, 'P' => 20, 'Q' => 18,'R'=>20,'S'=>20];
        foreach ($columnWidths as $column => $width) {
            $this->activeSheet->getColumnDimension($column)->setWidth($width);
        }
        $this->exportUsers($idTraining);
        $this->line+=3;
        $this->exportSessions($idTraining);
        $this->line+=3;
        $this->exportForms($idTraining);
        
    }
    
    
    public function exportUser(int $idUser){
        $columnWidths = ['A' => 10, 'B' => 10, 'C' => 10, 'D' => 20, 'E' => 20, 'F' => 15, 'G' => 15, 'H' => 15, 'I' => 25, 'J' => 15, 'K' => 15, 'L' => 17, 'M' => 15, 'N' => 20, 'O' => 20, 'P' => 20, 'Q' => 18, 'R'=>20, 'S'=>20];
        foreach ($columnWidths as $column => $width) {
            $this->activeSheet->getColumnDimension($column)->setWidth($width);
        }
        if (!UserModel::existUser($idUser)){
            return 615416;//code d'erreur;
        }else{
            $user = UserModel::getUser($idUser);
            $this->customStyle('H', $this->line, 1+count($user->comments));
            $this->activeSheet->mergeCells('F'.($this->line+2).':H'.($this->line+2));
            $this->nameColumns("USER");
            $user->setLineXLS($this->activeSheet, $this->line);
            if (!empty($user->comments)) {
                $this->line += count($user->comments);
            }
            $this->line++;
            $this->line+=3;
            if ($user->role==="student"){
                $forms = FormModel::getForms($idUser);
                $countComments=0;
                foreach($forms as $form) {
                    $countComments+=count($form->comments);
                }
                $this->customStyle('S', $this->line, count($forms)+$countComments);
                $this->activeSheet->mergeCells('Q'.($this->line+2).':S'.($this->line+2));
                $this->nameColumns("FORM");
                foreach($forms as $form) {
                    $form->setLineXLS($this->activeSheet, $this->line);
                    if (!empty($form->comments)) {
                        $this->line += count($form->comments);
                    }
                    $this->line++;
                }
            }
        }
    }

    private function nameColumns(string $tabName){
        switch ($tabName){
            case "USER":
                $this->activeSheet->setCellValue('A'.$this->line, 'UTILISATEURS');
                $columnTitle = ['A' => 'Id', 'B' => 'Nom', 'C' => 'Prénom', 'D' => 'Rôle','E' => 'Auteur commentaire','F' => 'Commentaire'];
                break;
            case "SESSION":
                $this->activeSheet->setCellValue('A'.$this->line, 'SESSIONS');
                $columnTitle = ['A' => 'Id', 'B' => 'Libellé', 'C' => 'Thème', 'D' => 'Description', 'E' => 'Date/Heure de début', 'F' => 'Date/Heure de fin',];
                break;
            case "FORM":
                $this->activeSheet->setCellValue('A'.$this->line, 'FICHES ÉLÈVES');
                $columnTitle = ['A' => 'Éducateur', 'B' => 'Étudiant', 'C' => 'Session', 'D' => 'Date de création', 'E' => 'Demandeur', 'F' => 'Localisation',
                'G' => 'Description', 'H' => 'Urgence', 'I' => 'Date intervention', 'J' =>  'Durée intervention','K' => 'Maintenance', 'L' => 'Intervention',
                'M' => 'Travaux faits', 'N' => 'Travaux non faits', 'O' => 'Nouvelle intervention','P'=>'Auteur commentaire','Q' => 'Commentaire'];
                break;
            }
        $this->line += 2;
        foreach ($columnTitle as $column => $title) {
            $this->activeSheet->setCellValue($column.$this->line, $title);
        }
        $this->line++;
    }

    private function customStyle(string $lastCell, $line, $numberOfLines){
        //Fusionner les cellules du titre
        $this->activeSheet->mergeCells('A'.$line.':'.$lastCell.($line+1));
        //Génère un chiffre aléatoire entre 0 et le nombre de couleurs disponibles
        $i = mt_rand(0, $this->nbColors-1);
        $this->nbColors--;
        //Applique la couleur au titre
        $this->activeSheet->getStyle('A'.$line)->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB($this->colorsTitle[$i]);
        array_splice($this->colorsTitle, $i, 1);
        $this->activeSheet->getStyle('A'.$line.':'.$lastCell.($line+1))->applyFromArray(self::STYLE_ARRAY);
        //Applique la couleur aux noms des colonnes
        $this->activeSheet->getStyle('A'.($line+2).':'.$lastCell.($line+2))->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB($this->colorsSubTitle[$i]);
        array_splice($this->colorsSubTitle, $i, 1);
        $this->activeSheet->getStyle('A'.($line+2).':'.$lastCell.($line+2))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_CENTER);
        //Applique la couleur aux contenu du tableau
        $this->activeSheet->getStyle('A'.($line+3).':'.$lastCell.($line+2+$numberOfLines))->getFill()->setFillType(Fill::FILL_SOLID)->getStartColor()->setARGB($this->colorsContent[$i]);
        array_splice($this->colorsContent, $i, 1);
        $this->activeSheet->getStyle('A'.($line+3).':'.$lastCell.($line+2+$numberOfLines))->getAlignment()->setHorizontal(Alignment::HORIZONTAL_LEFT);
        //Ajouter de la bordure
        $this->activeSheet->getStyle('A'.$line.':'.$lastCell.($line+2+$numberOfLines))->getBorders()->getAllBorders()->setBorderStyle(\PhpOffice\PhpSpreadsheet\Style\Border::BORDER_THIN);
    }

    private function exportUsers(int $idTraining) {
        $users = UserModel::getUsers($idTraining);
        if(!is_array($users)) {
            return 74585; // code d'erreur  
        }
        $countComments=0;
        foreach($users as $user) {
            $countComments+=count($user->comments);
        }
        $this->customStyle('H', $this->line, count($users)+$countComments);
        $this->activeSheet->mergeCells('F'.($this->line+2).':H'.($this->line+2));
        $this->nameColumns("USER");
        foreach($users as $user) {
            $user->setLineXLS($this->activeSheet, $this->line);
            // Si l'utilisateur a des commentaires, ajoute la taille du tableau de commentaires
            if (!empty($user->comments)) {
                $this->line += count($user->comments);
            }
            $this->line++;
        }
    }
    
    private function exportSessions(int $idTraining) {
        $sessions = SessionModel::getSessions($idTraining);
        if(!is_array($sessions)) {
            return 74586; // code d'erreur
        }
        $this->customStyle('F', $this->line, count($sessions));
        $this->nameColumns("SESSION");
        foreach($sessions as $session) {
            $session->setLineXLS($this->activeSheet, $this->line);
            $this->line++;
        }
    }

    private function exportForms(int $idTraining) {
        $forms = FormModel::getFormsByTraining($idTraining);
        if(!is_array($forms)) {
            return 74586; // code d'erreur
        }
        $countComments=0;
        foreach($forms as $form) {
            $countComments+=count($form->comments);
        }
        $this->customStyle('S', $this->line, count($forms)+$countComments);
        $this->activeSheet->mergeCells('Q'.($this->line+2).':S'.($this->line+2));
        $this->nameColumns("FORM");
        foreach($forms as $form) {
            $form->setLineXLS($this->activeSheet, $this->line);
            // Si la fiche a des commentaires, ajoute la taille du tableau de commentaires
            if (!empty($form->comments)) {
                $this->line += count($form->comments);
            }
            $this->line++;
        }
    }
    
    public function getFileXLS(string $fileName) { 
        header('Content-Type: application/vnd.ms-excel');
        header('Content-Disposition: attachment;filename='. $fileName);
        header('Cache-Control: max-age=0');
        $this->excel_writer->save('php://output');
    }
    

}