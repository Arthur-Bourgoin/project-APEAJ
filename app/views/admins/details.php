<?php
$title = "Page Information Elève";
$bsIcons = true;
$scripts = "<script src='/assets/js/admin/details.js' type = 'module'></script>
<script src='/assets/js/account.js' type='module'></script>";
ob_start(); ?>
<style>
    .comment-container:hover {
        background-color: lightgray;
        cursor: pointer;
    }
</style>

<div class="container ">
<div class="row">
        <div class="d-flex justify-content-end align-items-center">
            <div class="d-flex align-items-center ">
                <a href="/disconnect"><button class="btn btn-danger"><i class="bi bi-power me-2"></i>Se déconnecter</button></a> 
                <button class="btn" data-bs-toggle="modal" data-bs-target="#profileConsultation">
                    <i class="bi bi-person-circle " style="font-size: 3rem;"></i> 
                </button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-3 mt-3 mr-3 ">
        <?php if (!empty($student)) { ?>
            <img src="<?= $student->picture ?>" class="img-thumbnail" alt="Photo de l'étudiant 1"> 
        <?php } ?>
        </div>
        <div class="col-9">
            <div class="row mt-3 ms-3 align-items">
                <?php if (!empty($student)) { ?>
                <div class="col-12 my-3">
                    <h2>
                        <?= htmlentities($student->lastName) ?>
                        <?= htmlentities($student->firstName) ?>
                    </h2>
                </div>
                <div class="col-12 my-3">
                    <h5>
                        login:
                        <?= htmlentities($student->login) ?>
                    </h5>
                </div>
                <?php } ?>
                <div class = "row">
                    <div class = "col-12 col-sm-12 col-md-12">
                    <button type="button" class="btn btn-primary me-3" data-bs-toggle="modal" data-bs-target="#createFormModal">
                        <i class="bi bi-file-earmark-plus"> </i>Créer une nouvelle fiche
                    </button>
                    <?php if(isset($_SESSION["role"]) && in_array($_SESSION["role"], ['educator-admin', 'super-admin'])) { ?>
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#ModalModifie" data-id="<?= $student->idUser ?>">
                            <i class="bi bi-pencil"></i> Modifier les informations
                        </button>
                    <?php } ?>
                    <a href="/etudiants/suivi/<?=htmlentities($student->lastName)?>-<?=htmlentities($student->firstName)?>-<?=htmlentities($student->idUser)?>" class="btn btn-primary">
                    <i class="bi bi-bar-chart"></i> Suivi de l'étudiant
                    </a>
                    </div>
                </div>
                <div class="col-12 mt-4">
                    <?= App\Class\Feedback::getMessage() ?>
                </div>
            </div>
        </div>
    </div>
    <?php if (!empty($comments) && is_array($comments)){ ?>
    <div class="row">
        <h2>Commentaires</h2>
        <?php
        $foundId = false;
        foreach ($comments as $com) {
            echo $com->getTemplateCommentStudent();
            if ($com->educator->idUser === $_SESSION["id"]) {
                $foundId = true;
            }
        }
        ?>
    </div>
    <?php 
    }else
        $foundId = false;
     ?>
    <?php if (!$foundId) { ?>
        <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#ModalComs">
            <i class="bi bi-chat-left-text me-2"></i> Ajouter un commentaire
        </button>
    <?php
    }
    ?>
    <div class="row">
        <div class="col mt-3">
            <h2>
                Historique des fiches
            </h2>
        </div>
    </div>
    <?php if (!empty($currentForm)){ ?>
    <div class="row">
        <div class="row mb-3">
            <div class="col-3">
                <h5>Session courante</h5>
            </div>
            <div class="col-9">
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2 text-center mb-3">
                <a
                    href="/etudiants/<?= htmlentities($student->lastName) ?>-<?= htmlentities($student->firstName) ?>-<?= htmlentities($currentForm->form->idStudent) ?>/fiche-<?= htmlentities($currentForm->form->numero) ?>"><i
                        class="bi bi-file-earmark-text" style="font-size: 5rem"></i></a>
                <div class="col">
                    <?= htmlentities($currentForm->session->wording) ?>
                </div>
            </div>

        </div>
        <?php } 
        if (!empty($finishedForms && is_array($finishedForms))){ ?>
            <div class="row">
                <div class="col-3">
                    <h5>Sessions terminées</h5>
                </div>
                <div class="col-9">
                </div>
                <?php
                foreach ($finishedForms as $finishedForm) { ?>
                    <div class="col-6 col-sm-4 col-md-3 col-lg-2 text-center mb-3">
                        <a
                            href="/etudiants/<?= htmlentities($student->lastName) ?>-<?= htmlentities($student->firstName) ?>-<?= htmlentities($finishedForm->form->idStudent) ?>/fiche-<?= htmlentities($finishedForm->form->numero) ?>"><i
                                class="bi bi-file-earmark-text" style="font-size: 5rem"></i></a>

                        <div>
                            <?= $finishedForm->session->wording ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        <?php } ?>
    </div>
</div>
<!-- Modal update utilisateur-->
<div class="modal fade" id="ModalModifie" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="UpdateUserLabel" aria-hidden="true" data-type-pwd="<?= htmlentities($student->typePwd) ?>">
    <div class="modal-dialog">
        <form enctype="multipart/form-data" action="<?= $_SERVER["REQUEST_URI"] ?>" method="POST">
            <input type="hidden" id="idUser" name="idUser" value=<?= $student->idUser ?> />
            <input type="hidden" name="action" value="updateUser" />
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
                                <img id="imgUser" src=<?= $student->picture ?> class="w-100 border"
                                    alt="Image de l'utilisateur">
                            </label>
                            <input id="inputImgUser" type="file" class="d-none" name="picture">
                        </div>

                        <div class="col-8 d-flex flex-column justify-content-between">
                            <div class="mb-3">
                                <label for="inputLastName">Nom</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person-vcard"></i></span>
                                    <input id="inputLastName" type="text" class="form-control" name="lastName"
                                        value="<?= htmlentities($student->lastName) ?>">
                                </div>
                            </div>

                            <div class="mb-3">
                                <label for="inputFirstName">Prénom</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-person-vcard"></i></span>
                                    <input id="inputFirstName" type="text" class="form-control" name="firstName"
                                        value="<?= htmlentities($student->firstName) ?>">
                                </div>
                            </div>
                        </div>

                        <div class="col-12 mt-3">
                            <label for="inputTypePwd" class="form-label">Type de mot de passe</label>
                            <div class="input-group">
                                <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                <select class="form-select selectTypePwd" id="inputTypePwd" name="typePwd">
                                    <option value="1" <?= $student->typePwd === 1 ? 'selected' : "" ?>> Texte </option>
                                    <option value="2" <?= $student->typePwd === 2 ? "selected" : "" ?>> Code </option>
                                    <option value="3" <?= $student->typePwd === 3 ? "selected" : "" ?>> Schéma </option>
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
                                    <input id="inputVerifPwd" type="password" class="form-control input-pwd"
                                        name="verifPwd">
                                    <span role="button" class="input-group-text"><i class="bi bi-eye"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="codeField">
                            <div class="col-12 mt-3">
                                <label for="inputPwd" class="form-label">Code</label>
                                <div class="input-group">
                                    <input id="inputPwd" type="password" class="form-control input-pwd" name="pwd"
                                        pattern="[0-9]{4,6}">
                                    <span role="button" class="input-group-text"><i class="bi bi-eye"></i></span>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <label for="inputConfirmPwd" class="form-label">Confirmation du code</label>
                                <div class="input-group">
                                    <input id="inputVerifPwd" type="password" class="form-control input-pwd"
                                        name="verifPwd" pattern="[0-9]{4,6}">
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
                            <button type="button" class="btn btn-danger me-2" data-bs-dismiss="modal">
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
<div class="modal fade" id="ModalComs" tabindex="-1" aria-labelledby="ModalComs" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="AddComment">Ajouter un commentaire</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= $_SERVER["REQUEST_URI"] ?>" method="POST">
                    <input type="hidden" id="idStudent" name="idStudent" value="<?= $student->idUser ?>" />
                    <input type="hidden" name="action" value="addComment" />
                    <input type="hidden" name="lastUpdate" value="" />
                    <div class=" col-12 ">
                        <label for="Formtext" class="form-label pe-none">Contenu</label>
                        <textarea class=" form-control" id="Formtext" name="text"></textarea>
                    </div>
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

<div class="modal fade" id="ModalUpdateComs" tabindex="-1" aria-labelledby="ModalUpdateComs" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="UpdateComment">Modifier un commentaire</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= $_SERVER["REQUEST_URI"] ?>" method="POST">
                    <input type="hidden" name="action" value="updateComment" />
                    <input type="hidden" id="idStudent" name="idStudent" value="<?= $student->idUser ?>" />
                    <input type="hidden" id="idEducator" name="idEducator" />
                    <div class=" col-12 ">
                        <label for="formText" class="form-label pe-none">Contenu</label>
                        <textarea class=" form-control" id="formText" name="text"></textarea>
                    </div>
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

<div class="modal fade" id="createFormModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered">
    <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Création d'une nouvelle fiche</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body d-flex flex-column align-items-center">
            <div class="row col-10 my-3">
                <a href="/etudiants/<?= htmlentities($student->lastName) ?>-<?= htmlentities($student->firstName) ?>-<?= htmlentities($student->idUser) ?>/creer-fiche">
                    <button type="button" class="btn btn-primary col-12">Fiche vierge</button>
                </a>
            </div>
            <div class="row col-10 my-3">
                <a href="/choix-modele-fiche">
                    <button type="button" class="btn btn-primary col-12">Partir d'un modèle existant</button>
                </a>
            </div>
        </div>
    </div>
  </div>
</div>

<?php 
    require("../app/views/modalAccount.php");
?>
<script>
    const commentsStudentTab = <?= json_encode($comments) ?>;
    console.log(commentsStudentTab);
</script>

<?php $content = ob_get_clean();
require("../app/views/layout.php");
?>