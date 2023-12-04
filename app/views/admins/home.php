<?php $title = "Page Accueil Admin";
$bsIcons = true;

ob_start(); ?>

<div class="container">
    <div class="row">
        <h2 class="text-center mt-3"> Formation
            <?= htmlentities($formation[0]["Formation"]) ?>
        </h2>
    </div>
    <div class="row">
        <div class="col-10 col-lg-11">
            <button type="button" class="btn btn-primary m-3" data-bs-toggle="modal"
                data-bs-target="#ModalAjouterSession">
                Ajouter une session +
            </button>
        </div>

        <div class="col-2 col-lg-1">
            <a href="<https://google.com">
                <i class="bi bi-person-circle text-black " style="font-size: 3rem">
                </i>
            </a>
        </div>
    </div>

    <ul class="nav nav-tabs" id="myTab" role="tablist">
        <li class="nav-item" role="presentation">
            <button class="nav-link active" id="sessions-tab" data-bs-toggle="tab" data-bs-target="#sessions"
                type="button" role="tab" aria-controls="sessions" aria-selected="true">Sessions</button>
        </li>
        <li class="nav-item" role="presentation">
            <button class="nav-link" id="eleves-tab" data-bs-toggle="tab" data-bs-target="#eleves" type="button"
                role="tab" aria-controls="eleves" aria-selected="false">Élèves</button>
        </li>
    </ul>
    <div class="tab-content" id="myTabContent">
        <div class="tab-pane fade show active" id="sessions" role="tabpanel" aria-labelledby="sessions-tab">
            <table class="table table-lg table-hover table fs-3 ">
                <thead>
                    <tr>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    foreach ($sessions as $session) {
                        ?>
                        <tr>
                            <td><span class='font-large'>
                                    <?= htmlentities($session["session"]) ?>
                                </span></td>
                            <td><a href="sessions/<?= $session["ID"] ?>"><i class='bi bi-eye text-black'></i></a></td>
                        </tr>
                        <?php
                    }
                    ?>

                </tbody>
            </table>
        </div>
        <div class="tab-pane fade mt-3" id="eleves" role="tabpanel" aria-labelledby="eleves-tab">
            <div class="row mb-3 align-items-center">
                <?php
                foreach ($students as $student) { ?>
                    <div class="col-lg-3 col-md-4 col-6">
                        <div class="card mb-4">
                            <img src="<?= $student["picture"] ?>" class="img-thumbnail" alt="Photo de l\'étudiant 1">
                            <div class="card-body text-center">
                                <h5 class="card-title">
                                    <?= htmlentities($student["nom"]) ?>
                                </h5>
                                <p class="card-text">
                                    <?= htmlentities($student["prenom"]) ?>
                                </p>
                                <a href="etudiants/<?= $student["nom"] ?>-<?= $student["prenom"] ?>-<?= $student["ID"] ?>"
                                    class="btn btn-primary">Informations</a>
                            </div>

                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<div class="modal fade" id="ModalAjouterSession" tabindex="-1" aria-labelledby="ModalAjouterSessionLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalAjouterSessionLabel">Ajouter une nouvelle session</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="URL_de_votre_traitement_PHP" method="POST">
                    <div class="mb-3">
                        <label for="sessionName" class="form-label">Nom de la session</label>
                        <input type="text" class="form-control" id="sessionName" name="sessionName" required>
                    </div>
                    <div class="mb-3">
                        <label for="theme" class="form-label">Thème</label>
                        <input type="text" class="form-control" id="theme" name="theme" required>
                    </div>
                    <div class="mb-3">
                        <label for="course" class="form-label">Cours</label>
                        <input type="text" class="form-control" id="course" name="course" required>
                    </div>
                    <div class="mb-3">
                        <label for="startTime" class="form-label">Heure de début</label>
                        <input type="time" class="form-control" id="startTime" name="startTime" required>
                    </div>
                    <div class="mb-3">
                        <label for="endTime" class="form-label">Heure de fin</label>
                        <input type="time" class="form-control" id="endTime" name="endTime" required>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Annuler</button>
                        <button type="submit" class="btn btn-primary">Ajouter</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $content = ob_get_clean();
require("../app/views/layout.php");