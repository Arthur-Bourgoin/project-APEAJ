<?php
use PHPUnit\Framework\TestCase;
use App\Models\AdminModel;

class AdminModelTest extends TestCase {
    //Test pour vérifier que les sessions ne sont pas vides et sont des tableaux
    public function testGetAllSessionsReturnsNonEmptyArray() {
        $sessions = AdminModel::getAllSessions();
        $this->assertIsArray($sessions);
        $this->assertNotEmpty($sessions);
    }
    //Test pour vérifier que les étudiants ne sont pas vides et sont des tableaux
    public function testGetAllStudentsReturnsNonEmptyArray() {
        $students = AdminModel::getAllStudents();
        $this->assertIsArray($students);
        $this->assertNotEmpty($students);
    }
     //Test pour vérifier que les formations ne sont pas vides et sont des tableaux
    public function testGetFormationAdminReturnsNonEmptyArray() {
        $formation = AdminModel::getFormationAdmin(1);
        $this->assertIsArray($formation);
        $this->assertNotEmpty($formation);
    }
 //Test pour vérifier que lorsqu'on récupère un etudiant,la structure de données est un tableau et que son noù,son prénom et son ID sont bien définis
    public function testGetStudentByIdReturnsValidStudent() {
        $studentId = 1; // ID aléatoire
        $student = AdminModel::getStudentById($studentId);
        $this->assertNotNull($student);
        $this->assertEquals($studentId, $student['ID']);
        $this->assertArrayHasKey('ID', $student);
        $this->assertEquals($studentId, $student['ID']);
        $this->assertArrayHasKey('nom', $student);
        $this->assertArrayHasKey('prenom', $student);
    }

    public function testGetFichesFiniesByStudentIdReturnsNonEmptyArray() {
        $studentId = 1;
        $fichesF = AdminModel::getFichesFiniesByStudentId($studentId);
        $this->assertIsArray($fichesF);
        $this->assertNotEmpty($fichesF);
    }

    public function testGetFichesNonFiniesByStudentIdReturnsNonEmptyArray() {
        $studentId = 1; 
        $fichesNF = AdminModel::getFichesNonFiniesByStudentId($studentId);
        $this->assertIsArray($fichesNF);
        $this->assertNotEmpty($fichesNF);
    }

    public function testGetStudentsBySessionReturnsNonEmptyArray() {
        $sessionId = 1; 
        $students = AdminModel::getStudentsBySession($sessionId);
        $this->assertIsArray($students);
        $this->assertNotEmpty($students);
    }

    public function testGetFichesBySessionReturnsNonEmptyArrayValidData() {
        $sessionId = 1;
        $fiches = AdminModel::getFichesBySession($sessionId);
        $this->assertIsArray($fiches);
        $this->assertNotEmpty($fiches);
        foreach ($fiches as $fiche) {
            $this->assertIsArray($fiche);
            $this->assertArrayHasKey('ID', $fiche);
            $this->assertArrayHasKey('Etat', $fiche);
            $this->assertArrayHasKey('NomEtu', $fiche);
            $this->assertArrayHasKey('PrenomEtu', $fiche);
            $this->assertArrayHasKey('IDstu', $fiche);
        }
    }

    public function testGetDescriptionReturnsNonEmptyArray() {
        $sessionId = 1; 
        $description = AdminModel::getDescription($sessionId);
        $this->assertIsArray($description);
        $this->assertNotEmpty($description);
    }

    public function testGetFormbyIDReturnsNonEmptyArray() {
        $formId = 1; 
        $form = AdminModel::getFormbyID($formId);
        $this->assertIsArray($form);
        $this->assertNotEmpty($form);
    }

    public function testGetComsByFormIDReturnsNonEmptyArray() {
        $formId = 1; 
        $coms = AdminModel::getComsByFormID($formId);
        $this->assertIsArray($coms);
        $this->assertNotEmpty($coms);
    }

    public function testGetPicturesByFormIDReturnsNonEmptyArray() {
        $formId = 1; 
        $pictures = AdminModel::getPicturesByFormID($formId);
        $this->assertIsArray($pictures);
        $this->assertNotEmpty($pictures);
    }
    
}