<?php

namespace App\Class;
use PhpOffice\PhpSpreadsheet\Worksheet\Worksheet;


class Form {

   public $form;
   public $comments;
   public $pictures;
   public $elements;
   public $materials;
   public $session;
   public $student;
   public $educator;

    public function __construct(object $form,?array $comments,?array $pictures,?array $elements,?array $materials,?object $session,?object $student,?object $educator) {
        $this->form = $form;
        $this->comments = $comments;
        $this->pictures = $pictures;
        $this->elements = $elements;
        $this->materials = $materials;
        $this->session = $session;
        $this->student = $student;
        $this->educator = $educator;
    }

    public function setLineXLS(Worksheet $sheet, int $line){
        $sheet->setCellValue('A'.$line , $this->form->idEducator);
        $sheet->setCellValue('B'.$line , $this->form->idStudent);
        $sheet->setCellValue('C'.$line , $this->form->idSession);
        $sheet->setCellValue('D'.$line , $this->form->creationDate);
        $sheet->setCellValue('E'.$line , $this->form->educatorNote);
        $sheet->setCellValue('F'.$line , $this->form->studentNote);
        $sheet->setCellValue('G'.$line , $this->form->applicantName);
        $sheet->setCellValue('H'.$line , $this->form->location);
        $sheet->setCellValue('I'.$line , $this->form->description);
        $sheet->setCellValue('J'.$line , $this->form->urgencyDegree);
        $sheet->setCellValue('K'.$line , $this->form->interventionDate);
        $sheet->setCellValue('L'.$line , $this->form->interventionDuration);
        switch ($this->form->maintenanceType){
            case 1:
                $sheet->setCellValue('M'.$line , 'Améliorative');
                break;
            case 2:
                $sheet->setCellValue('M'.$line , 'Préventive');
                break;
            case 3:
                $sheet->setCellValue('M'.$line , 'Corrective');
                break;          
        }
        switch ($this->form->interventionNature){
            case 1:
                $sheet->setCellValue('N'.$line , 'Aménagement');
                break;
            case 2:
                $sheet->setCellValue('N'.$line , 'Finitions');
                break;
            case 3:
                $sheet->setCellValue('N'.$line , 'Installation sanitaire');
                break;
            case 4:
                $sheet->setCellValue('N'.$line , 'Installation électrique');
                break;     
        }
        $sheet->setCellValue('O'.$line , $this->form->workDone);
        $sheet->setCellValue('P'.$line , $this->form->workNotDone);
        if ($this->form->workNotDone===null){
            $sheet->setCellValue('P'.$line ,' ');
        }
        switch ($this->form->newIntervention){
            case false:
                $sheet->setCellValue('Q'.$line , 'Non');
                break;
            case true:
                $sheet->setCellValue('Q'.$line , 'Oui');
                break;
        }
        if ($this->form->newIntervention===null){
            $sheet->setCellValue('Q'.$line , ' ');
        }
        $sheet->mergeCells('R'.$line.':U'.$line);
        foreach($this->comments as $comment) {
            $line++;
            $sheet->mergeCells('S'.$line.':U'.$line);
            $sheet->setCellValue('R'.$line, $comment->author->lastName);
            $sheet->setCellValue('S'.$line, $comment->text);
    }
        $line++;
    }
}