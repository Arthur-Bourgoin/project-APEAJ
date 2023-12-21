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
        //$sheet->setCellValue('E'.$line , $this->form->educatorNote);
        //$sheet->setCellValue('F'.$line , $this->form->studentNote);
        $sheet->setCellValue('E'.$line , $this->form->applicantName);
        $sheet->setCellValue('F'.$line , $this->form->location);
        $sheet->setCellValue('G'.$line , $this->form->description);
        $sheet->setCellValue('H'.$line , $this->form->urgencyDegree);
        $sheet->setCellValue('I'.$line , $this->form->interventionDate);
        $sheet->setCellValue('J'.$line , $this->form->interventionDuration);
        switch ($this->form->maintenanceType){
            case 1:
                $sheet->setCellValue('K'.$line , 'Améliorative');
                break;
            case 2:
                $sheet->setCellValue('K'.$line , 'Préventive');
                break;
            case 3:
                $sheet->setCellValue('K'.$line , 'Corrective');
                break;          
        }
        switch ($this->form->interventionNature){
            case 1:
                $sheet->setCellValue('L'.$line , 'Aménagement');
                break;
            case 2:
                $sheet->setCellValue('L'.$line , 'Finitions');
                break;
            case 3:
                $sheet->setCellValue('L'.$line , 'Installation sanitaire');
                break;
            case 4:
                $sheet->setCellValue('L'.$line , 'Installation électrique');
                break;     
        }
        $sheet->setCellValue('M'.$line , $this->form->workDone);
        $sheet->setCellValue('N'.$line , $this->form->workNotDone);
        if ($this->form->workNotDone===null){
            $sheet->setCellValue('N'.$line ,' ');
        }
        switch ($this->form->newIntervention){
            case false:
                $sheet->setCellValue('O'.$line , 'Non');
                break;
            case true:
                $sheet->setCellValue('O'.$line , 'Oui');
                break;
        }
        if ($this->form->newIntervention===null){
            $sheet->setCellValue('O'.$line , ' ');
        }
        $sheet->mergeCells('P'.$line.':S'.$line);
        foreach($this->comments as $comment) {
            $line++;
            $sheet->mergeCells('Q'.$line.':S'.$line);
            $sheet->setCellValue('P'.$line, $comment->author->lastName);
            $sheet->setCellValue('Q'.$line, $comment->text);
    }
        $line++;
    }
}