<?php $title = "Page Accueil Admin";
$bsIcons = true;
$scripts = "<script src='/assets/js/class/alert.js' type='module'></script>
            <script src='/assets/js/admin/home.js' type='module'></script>";
ob_start(); ?>

<div class="container position-relative">
    <div class="col-lg-1 position-absolute top-0 end-0">
        <a href="https://google.com">
            <i class="bi bi-person-circle text-black" style="font-size: 3rem;"></i>
        </a>
    </div>
    <div class="row">
        <h2 class="text-center mt-3"> Formation
        </h2>
    </div>
    <div class="row">
        <div class="col-10 col-lg-11">
            <button type="button" class="btn btn-primary my-3" data-bs-toggle="modal"
                data-bs-target="#ModalAjouterSession">
                <i class="bi bi-plus-circle"></i> Ajouter une session
            </button>
        </div>
    </div>
    <?php
    switch ($error) {
        case 1:
            echo "<div class='alert alert-danger'> Les données ne sont pas valides </div>";
            break;
        case 2:
            echo "<div class='alert alert-danger'> Une erreur s'est produite lors de l'affichage </div>";
            break;
        case 3:
            echo "<div class='alert alert-danger'>  </div>";
            break;
    }
    switch ($success) {
        case 1:
            echo "<div class='alert alert-success'> Création de la session réussie ! </div>";
            break;
        case 2:
            echo "<div class='alert alert-success'> Modification de l'utilisateur réussie ! </div>";
            break;
        case 3:
            echo "<div class='alert alert-success'>  </div>";
            break;
    }
    ?>
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
                                    <?= htmlentities($session->wording) ?>
                                </span></td>
                            <td><a href="sessions/<?= $session->idSession ?>"><i class='bi bi-eye text-black'></i></a></td>
                        </tr>
                        <?php
                    }
                    ?>

                </tbody>
            </table>
        </div>
        <div class="tab-pane fade mt-3" id="eleves" role="tabpanel" aria-labelledby="eleves-tab">
            <div class="row mb-3 align-items-center user-container">
                <?php
                foreach ($students as $student) { ?>
                    <div class="col-lg-3 col-md-4 col-6 ">
                        <div class="card mb-4">
                            <img src="<?= $student->picture ?>" class="img-thumbnail" alt="Photo de l'étudiant 1">
                            <div class="card-body text-center">
                                <h5 class="card-title">
                                    <?= htmlentities($student->lastName) ?>
                                </h5>
                                <p class="card-text">
                                    <?= htmlentities($student->firstName) ?>
                                </p>
                                <div class="row align-items-center">
                                    <div class="col-8">
                                        <a href="etudiants/<?= $student->lastName ?>-<?= $student->firstName ?>-<?= $student->idUser ?>"
                                            class="btn btn-primary"><i class="bi bi-info-circle"></i></a>
                                    </div>
                                    <div class="col-2">
                                        <button type="button" class="btn btn-primary button-update" data-bs-toggle="modal"
                                            data-bs-target="#ModalModifie" data-id="<?= $student->idUser ?>">
                                            <i class="bi bi-pencil"></i>
                                        </button>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>

</div>
<div class="modal fade" id="ModalAjouterSession" tabindex="-1" aria-labelledby="ModalAjouterSessionLabel"
    aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="ModalAjouterSessionLabel">Ajouter une nouvelle session</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="/" method="POST">
                    <div class="mb-3">
                        <input type="hidden" class="form-control" id="action" name="action" value="addSession">
                        <input type="hidden" class="form-control" id="idTraining" name="idTraining" value=1>
                        <label for="sessionName" class="form-label">Nom de la session</label>
                        <input type="text" class="form-control" id="sessionName" name="wording" required>
                    </div>
                    <div class="mb-3">
                        <label for="theme" class="form-label">Thème</label>
                        <input type="text" class="form-control" id="theme" name="theme" required>
                    </div>
                    <div class="mb-3">
                        <label for="startTime" class="form-label">Date/Heure de début</label>
                        <input type="datetime-local" class="form-control" id="startTime" name="timeBegin" required>
                    </div>
                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description"></textarea>
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
<!-- Modal ajout utilisateur-->
<div class="modal fade" id="ModalModifie" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="UpdateUserLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form enctype="multipart/form-data" action="<?= $_SERVER ["REQUEST_URI"]?>" method="POST">
                <input type="hidden" id="idUser" name="idUser" value="" />
                <input type="hidden" name="action" value="updateStudent" />
                <input type="hidden" name="MAX_FILE_SIZE" value="300000" />   
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newUserLabel">Modifier utilisateur</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="col-4">
                                <label for="inputImgUser">
                                    <img id="imgUser" src="" class="w-100 border" alt="Image de l'utilisateur">
                                </label>
                                <input id="inputImgUser" type="file" class="d-none" name="picture">
                            </div>

                            <div class="col-8 d-flex flex-column justify-content-between">
                                <div class="mb-3">
                                    <label for="inputLastName">Nom</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person-vcard"></i></span>
                                        <input id="inputLastName" type="text" class="form-control" name="lastName">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="inputFirstName">Prénom</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person-vcard"></i></span>
                                        <input id="inputFirstName" type="text" class="form-control" name="firstName">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12 mt-3">
                                <label for="inputTypePwd" class="form-label">Type de mot de passe</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                    <select class="form-select selectTypePwd" id="inputTypePwd" name="typePwd">
                                        <option value="1"  <?=$student->typePwd === 1 ? 'selected' : "" ?>> Texte </option>
                                        <option value="2"  <?=$student->typePwd === 2 ? "selected" : "" ?>> Code </option>
                                        <option value="3" <?=$student->typePwd === 3 ? "selected" : "" ?>> Schéma </option>
                                    </select>
                                </div>
                            </div>
                            <div class="textField">
                                <div class="col-12 mt-3">
                                    <label for="inputPwd" class="form-label">Mot de passe</label>
                                    <div class="input-group">
                                        <input id="inputPwd" type="password" class="form-control input-pwd" name="pwd">
                                        <span role="button" class="input-group-text"><i class="bi bi-eye"></i></span>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="inputConfirmPwd" class="form-label">Confirmation du mot de passe</label>
                                    <div class="input-group">
                                        <input id="inputVerifPwd" type="password" class="form-control input-pwd" name="verifPwd">
                                        <span role="button" class="input-group-text"><i class="bi bi-eye"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="codeField">
                                <div class="col-12 mt-3">
                                    <label for="inputPwd" class="form-label">Code</label>
                                    <div class="input-group">
                                        <input id="inputPwd" type="password" class="form-control input-pwd" name="pwd" pattern="[0-9]{4,6}">
                                        <span role="button" class="input-group-text"><i class="bi bi-eye"></i></span>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="inputConfirmPwd" class="form-label">Confirmation du code</label>
                                    <div class="input-group">
                                        <input id="inputVerifPwd" type="password" class="form-control input-pwd" name="verifPwd" pattern="[0-9]{4,6}">
                                        <span role="button" class="input-group-text"><i class="bi bi-eye"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div class="schemaField">
                                <div class="col-12 mt-3">
                                    schéma
                                </div>
                                <div class="col-12 mt-3">
                                    confirmation schéma
                                </div>
                            </div>
                            <div class="modal-footer text-center">
                                <button type="button" class="btn btn-cancel btn-danger me-2" data-bs-dismiss="modal">
                                    <i class="bi bi-x-circle me-2"></i>Annuler
                                </button>
                                <button type="submit" class="btn btn-success">
                                    <i class="bi bi-check-circle me-2"></i>Valider
                                </button>
                            </div>
                        </div>  
                    </div>  
                </div>
            </form>
        </div>
    </div>

<script>
    const studentsTab = <?= json_encode($students) ?>;
    console.log(studentsTab);
</script>
<?php $content = ob_get_clean();
require("../app/views/layout.php");