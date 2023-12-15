<?php
$title = "Page Information Elève";
$bsIcons = true;
$scripts = "<script src='/assets/js/updateStudent.js' type='module'></script>
<script src='/assets/js/class/alert.js' type='module'></script>;"
    ?>


<?php ob_start(); ?>

<div class="container">
    <div class="row">
        <div class="col-3 mt-3 mr-3 ">
            <img src="<?= $student->picture ?>" class="img-thumbnail" alt="Photo de l\'étudiant 1">
        </div>
        <div class="col-9">
            <div class="row mt-3 ms-3 align-items">
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

                <div class="row">
                    <div class="col-12 col-sm-12 col-md-12">
                        <a
                            href="/etudiants/<?= htmlentities($student->lastName) ?>-<?= htmlentities($student->firstName) ?>-<?= htmlentities($student->idUser) ?>/creer-fiche"><button
                                type="button" class="btn btn-primary mt-3 me-2">Créer une fiche</button></a>
                        <button type="button" class="btn btn-primary mt-3 " data-bs-toggle="modal"
                            data-bs-target="#ModalModifie" data-id="<?= $student->idUser ?>">
                            Modifier les informations
                        </button>
                    </div>
                </div>
                <div class="col-12 mt-4">
                    <?php
                    if (isset($result)) {
                        if ($result === 0) {
                            ?>
                            <div class="alert alert-success" role="alert">
                                Modification réussie !
                            </div>
                            <?php
                        } else if ($result === 1) {
                            ?>
                                <div class="alert alert-danger" role="alert">
                                    L'utilisateur n'existe pas !
                                </div>
                            <?php
                        } else if ($result === 2) {
                            ?>
                                    <div class="alert alert-danger" role="alert">
                                        Erreur de requête !
                                    </div>
                            <?php
                        }
                    }
                    ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col mt-3">
            <h2>
                Historique des fiches
            </h2>
        </div>
    </div>
    <div class="row border border-5 my-3 ">
        <div class="row mb-3">
            <div class="col-3">
                <h5>Session courante</h5>
            </div>
            <div class="col-9">
            </div>
            <div class="col-6 col-sm-4 col-md-3 col-lg-2 text-center mb-3">
                <a
                    href="/etudiants/<?= htmlentities($student->lastName) ?>-<?= htmlentities($student->firstName) ?>-<?= $currentForm->form->idStudent ?>/fiche-<?= $currentForm->form->numero ?>"><i
                        class="bi bi-file-earmark-text" style="font-size: 5rem"></i></a>
                <div class="col">
                    <?= $currentForm->session->wording ?>
                </div>
            </div>

        </div>
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
    </div>
</div>
<div class="modal fade" id="ModalModifie" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="editformationLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editformationLabel">Modification formation</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <form action="<?= $_SERVER["REQUEST_URI"] ?>" method="POST">
                    <input type="hidden" name="role" value="<?= $student->role ?>" />
                    <input type="hidden" name="idUser" value="<?= $student->idUser ?>" />
                    <div class="row">
                        <div class=" col-5 text-center mt-1">
                            <input type="file" id="input-img" class="d-none" name="picture">
                            <label for="input-img"> <img src="<?= $student->picture ?>" class=" w-75 border border-3"
                                    alt="Image formation"></label>
                        </div>
                        <div class="col-7">
                            <div class="  col-12 ">
                                <label for="FormName" class="form-label pe-none"></label>
                                <input class=" form-control" id="FormName" value="<?= $student->lastName ?>"
                                    name="lastName">
                            </div>
                            <div class=" col-12 ">
                                <label for="FormFirstName" class="form-label pe-none"></label>
                                <input class=" form-control" id="FormFirstName" value="<?= $student->firstName ?>"
                                    name="firstName">
                            </div>

                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-5 text-center m-auto">
                            <label for="test" class="form-label pe-none">Login :</label>
                        </div>
                        <div class="col-7 ">
                            <input class=" form-control" id="test" value="<?= $student->login ?>" name="login">
                        </div>
                        <div class="col-5 text-center mt-4">
                            <label for="passwdSelect" class="form-label pe-none">Type de mdp :</label>
                        </div>
                        <div class="col-7 mt-4">
                            <select id="passwdSelect" class="form-select" name="typePwd">
                                <option <?= $student->typePwd === 1 ? 'selected' : "" ?>> Texte </option>
                                <option <?= $student->typePwd === 3 ? "selected" : "" ?>> Schéma </option>
                                <option <?= $student->typePwd === 2 ? "selected" : "" ?>> Code </option>
                            </select>
                        </div>
                        <div id="champTexte" class="champ col-12 mt-4">
                            <div class="row">
                                <div class="col-5 text-center">
                                    <label for="FormPasswd" class="form-label">Mot de passe :</label>
                                </div>
                                <div class="col-7 ">
                                    <input class="form-control " id="FormPasswd" type="password">
                                </div>
                                <div class="col-5 text-center">
                                    <label for="FormPasswdConfirm" class="form-label pe-none">Confirmer mot
                                        depasse:</label>
                                </div>
                                <div class="col-7">
                                    <input class="form-control" id="FormPasswdConfirm" type="password">
                                </div>
                            </div>
                        </div>

                        <div id="champSchéma" class="champ col-12 mt-4">
                            <div>blabla</div>
                        </div>

                        <div id="champCode" class="champ col-12 mt-4">
                            <div class="row">
                                <div class="col-5 text-center">
                                    <label for="codeField" class="form-label pe-none">Code:</label>
                                </div>
                                <div class="col-7">
                                    <input class="form-control" id="codeField" type="text">
                                </div>
                                <div class="col-5 text-center">
                                    <label for="codeFieldConfirm" class="form-label pe-none">Confirmer le code :</label>
                                </div>
                                <div class="col-7">
                                    <input class="form-control champ-form" id="codeFieldConfirm" type="text">
                                </div>
                            </div>
                        </div>

                    </div>
                    <div id="errorMessage" style="color: red;"></div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                        <button type="submit" class="btn btn-primary">Valider</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<?php $content = ob_get_clean();
require("../app/views/layout.php");
?>