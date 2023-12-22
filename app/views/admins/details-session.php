<?php
$title = "Page Information session";
$bsIcons = true;
$scripts = "<script src = '/assets/js/admin/details-session.js' type = 'module'></script>
<script src='/assets/js/account.js' type='module'></script>";
?>

<?php ob_start(); ?>
<div class="container">

    <div class="row">
        <h2 class="text-center mt-3">
            <?= htmlentities($session->wording) ?>
        </h2>
        <div class="d-flex justify-content-between align-items-center">
            <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal"
                data-bs-target="#ModalModifierSession">
                <i class="bi bi-pencil"></i> Modifier la session
            </button>
            <div class="d-flex align-items-center">
                <a href="/disconnect"><button class="btn btn-danger"><i class="bi bi-power me-2"></i>Se
                        déconnecter</button></a>
                <button class="btn" data-bs-toggle="modal" data-bs-target="#profileConsultation">
                    <i class="bi bi-person-circle " style="font-size: 3rem;"></i>
                </button>
            </div>
        </div>
    </div>

    <?php
    if ($session->timeEnd == NULL) { ?>
        <div class="col-12 mt-2">
            <form action="<?= $_SERVER["REQUEST_URI"] ?>" method="POST">
                <button type="submit" class="btn btn-primary btn-close-session "> <i class="bi bi-x-lg"></i> Fermer la
                    Session</button>
                <input type="hidden" name="action" value="closeSession">
                <input type="hidden" name="idSession" value="<?= $session->idSession ?>">
            </form>
        </div>
    <?php } ?>

<div class="mt-2">
    <?php
    switch ($error) {
        case 501:
            echo "<div class = 'alert alert-danger'> Les données ne sont pas valides </div>";
            break;
        case 2:
            echo "<div class = 'alert alert-danger'> Erreur de requête ! </div>";
            break;
        case 3:
            echo "<div class = 'alert alert-danger'> Une erreur s'est produite lors de l'affichage </div>";
            break;
        case 707:
            echo "<div class = 'alert alert-danger'> Vous ne pouvez pas modifier un profil qui n'est pas le votre </div>";
            break;
    }
    switch ($success) {
        case 1:
            echo "<div class = 'alert alert-success'> Modification de la session réussie ! </div>";
            break;
        case 2:
            echo "<div class = 'alert alert-success'> Fermeture de la session réussie ! </div>";
            break;
        case 3:
            echo "<div class = 'alert alert-success'>  </div>";
            break;
        case 12:
            echo "<div class = 'alert alert-success'> Modification profil réussie ! </div>";
            break;
    }
    ?>
</div>
<div class="row  my-3">
    <div class="col-12">
        <div class="form-floating">
            <div class="form-control" id="descriptionSession">
                <?= htmlentities($session->description) ?>
            </div>
            <label for="descriptionSession">Description</label>
        </div>
    </div>
</div>
<div class="row">
    <?php foreach ($forms as $form) { ?>
        <div class="col-6 col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <a
                        href="/etudiants/<?= htmlentities($form->student->lastName) ?>-<?= htmlentities($form->student->firstName) ?>-<?= htmlentities($form->student->idUser) ?>/fiche-<?= htmlentities($form->form->numero) ?>">
                        <i class="bi bi-file-earmark-text" style="font-size: 5rem;"></i>
                    </a>
                    <h5 class="card-title mt-3">
                        <?= htmlentities($form->student->lastName . " " . $form->student->firstName) ?>
                    </h5>
                </div>
            </div>
        </div>
    <?php } ?>
    <?php if ($session->timeEnd == NULL) { ?>
        <div class="col-6 col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#NewFormForStudent">
                        <i class="bi bi-plus-circle" style="font-size: 5rem;"></i>
                    </a>
                    <h5 class="card-title mt-3">Ajouter une fiche</h5>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<div class="modal fade" id="ModalModifierSession" tabindex="-1" aria-labelledby="ModalModifierSessionLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalModifierSessionLabel">Modifier la session</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/sessions/<?= $session->idSession ?>" method="POST">
                    <div class="mb-3">
                        <input type="hidden" class="form-control" id="action" name="action" value="updateSession">
                        <input type="hidden" class="form-control" id="idSession" name="idSession"
                            value="<?= $session->idSession ?>">
                        <input type="hidden" class="form-control" id="idTraining" name="idTraining" value=1>
                        <label for="sessionName" class="form-label">Nom de la session</label>
                        <input type="text" class="form-control" id="sessionName" name="wording"
                            value="<?= htmlentities($session->wording) ?>" required>
                    </div>
                    <div class="mb-3">
                        <label for="theme" class="form-label">Thème</label>
                        <input type="text" class="form-control" id="theme" name="theme"
                            value="<?= htmlentities($session->theme) ?>" required>
                    </div>
                    <?php if ($session->timeEnd == NULL) { ?>
                        <div class="mb-3">
                            <label for="startTime" class="form-label">Date/Heure de début</label>
                            <input type="datetime-local" class="form-control" id="startTime" name="timeBegin"
                                value="<?= htmlentities($session->timeBegin) ?>" required>
                            <!-- Affichage de la date de début modifiable si la date de fin n'est pas définie -->
                        </div>
                    <?php } else { ?>
                        <div class="mb-3">
                            <label for="startTime-readonly" class="form-label">Date/Heure de début</label>
                            <input type="datetime-local" class="form-control" id="startTime-readonly" name="timeBegin"
                                value="<?= htmlentities($session->timeBegin) ?>" readonly required>
                            <!-- Rendre la date de début non modifiable si la date de fin est définie -->
                        </div>
                    <?php } ?>
                    <?php if ($session->timeEnd !== NULL) { ?>
                        <div class="mb-3">
                            <label for="endTime-readonly" class="form-label">Date/Heure de fin</label>
                            <input type="datetime-local" class="form-control" id="endTime-readonly" name="timeEnd"
                                value="<?= htmlentities($session->timeEnd) ?>" readonly>
                            <!-- Affichage de la date de fin dans un champ 'readonly' si elle est définie -->
                        </div>
                    <?php } ?>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description"
                            name="description"><?= htmlentities($session->description) ?></textarea>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-cancel btn-danger me-2" data-bs-dismiss="modal">
                            <i class="bi bi-x-circle me-2"></i>Annuler
                        </button>
                        <button type="submit" class="btn btn-success">
                            <i class="bi bi-check-circle me-2"></i>Valider
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>


<div class="modal fade" id="NewFormForStudent" tabindex="-1" aria-labelledby="NewFormForStudentLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="NewFormForStudentLabel">Liste des étudiants</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <table class="table table-bordered table-hover">
                    <thead class="table-dark">
                        <tr>
                            <th scope="col">Nom</th>
                            <th scope="col">Prénom</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php foreach ($students as $student) { ?>
                            <tr class="tr-body" data-id="<?= $student->idUser ?>">
                                <td>
                                    <?= htmlentities($student->lastName) ?>
                                </td>
                                <td>
                                    <?= htmlentities($student->firstName) ?>
                                </td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
            </div>
        </div>
    </div>
</div>


<?php
require("../app/views/modalAccount.php");
$content = ob_get_clean();
require("../app/views/layout.php");
?>