<?php $title = "Page Information Elève";
$bsIcons = true;
$scripts = "<script src='/assets/js/modif_student.js' type='module'></script>";


?>


<?php ob_start(); ?>

<div class="container">
    <div class="row">
        <div class="col-3 mt-3 mr-3 ">
            <img src="<?= $student["picture"] ?>" class="img-thumbnail" alt="Photo de l\'étudiant 1">
        </div>
        <div class="col-9">
            <div class="row mt-3 ms-3 align-items">
                <div class="col-12 my-3">
                    <h2>
                        <?= htmlentities($student["nom"]) ?>
                        <?= htmlentities($student["prenom"]) ?>
                    </h2>
                </div>
                <div class="col-12 my-3">
                    <h5>
                        login:
                        <?= htmlentities($student["login"]) ?>
                    </h5>
                </div>

                <div class="col-12 ">
                    <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal"
                        data-bs-target="#ModalModifie" data-id="<?= $student["ID"] ?>">
                        Modifier les informations
                    </button>
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
            
                <?php
                foreach ($fichesnf as $fichenf) { ?>
                    <div class="col-6 col-sm-4 col-md-3 col-lg-2 text-center mb-3">
                        <a
                            href="/etudiants/<?= htmlentities($fichenf["NomEtu"]) ?>-<?= htmlentities($fichenf["PrenomEtu"]) ?>-<?= htmlentities($fichenf["IDstu"]) ?>/fiche-<?= htmlentities($fichenf["ID"]) ?>"><i
                                class="bi bi-file-earmark-text" style="font-size: 5rem"></i></a>
                        <div class= "col-12">
                            Session
                            <?= htmlentities($fichenf["ID"]) ?>
                        </div>
                    </div>
                    <?php
                }
                ?>
        </div>
        <div class="row">
            <div class="col-3">
                <h5>Sessions terminées</h5>
            </div>
            <div class="col-9">
            </div>
            <?php
            foreach ($fichesf as $fichef) { ?>
                <div class="col-6 col-sm-4 col-md-3 col-lg-2 text-center mb-3">
                    <a
                        href="/etudiants/<?= htmlentities($fichef["NomEtu"]) ?>-<?= htmlentities($fichef["PrenomEtu"]) ?>-<?= htmlentities($fichef["IDstu"]) ?>/fiche-<?= htmlentities($fichef["ID"]) ?>"><i
                            class="bi bi-file-earmark-text" style="font-size: 5rem"></i></a>

                    <div>
                        Session
                        <?= htmlentities($fichef["ID"]) ?>
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
                    <div class="row">
                        <div class=" col-5 text-center mt-1">
                            <img src="<?= $student['picture'] ?>" class=" w-75 border border-3" alt="Image formation">
                        </div>
                        <div class="col-7">
                            <div class="  col-12 ">
                                <label for="FormName" class="form-label pe-none"></label>
                                <input class=" form-control" id="FormName" value="<?= $student['nom'] ?>"name="name">
                            </div>
                            <div class=" col-12 ">
                                <label for="FormFirstName" class="form-label pe-none"></label>
                                <input class=" form-control" id="FormFirstName" value="<?= $student['prenom'] ?>" name="firstname">
                            </div>

                        </div>
                    </div>
                    <div class="row mt-2">
                        <div class="col-5 text-center m-auto">
                            <label for="test" class="form-label pe-none">Login :</label>
                        </div>
                        <div class="col-7 ">
                            <input class=" form-control" id="test" value="<?= $student['login'] ?>" name="login">
                        </div>
                        <div class="col-5 text-center mt-4">
                            <label for="passwdSelect" class="form-label pe-none">Type de mdp :</label>
                        </div>
                        <div class="col-7 mt-4">
                            <select id="passwdSelect" class="form-select">
                                <option <?php if ($student["typemdp"] === "texte")
                                    echo 'selected' ?>>Texte
                                    </option>
                                    <option <?php if ($student["typemdp"] === "schéma")
                                    echo 'selected' ?>>Schéma
                                    </option>
                                    <option <?php if ($student["typemdp"] === "code")
                                    echo 'selected' ?>>Code
                                    </option>
                                </select>
                            </div>
                            <div id="champTexte" class="champ" style="display: none;">
                                <div class="row align-items-center mt-4">
                                    <div class="col-5 text-center">
                                        <label for="FormPasswd" class="form-label pe-none">Mot de
                                            passe :</label>
                                    </div>
                                    <div class="col-7">
                                        <input class="form-control champ-form" id="FormPasswd" type="password" name="password">
                                    </div>
                                </div>
                                <div class="row align-items-center mt-4">
                                    <div class="col-5 text-center">
                                        <label for="FormPasswdConfirm" class="form-label pe-none">Confirmer mot de passe
                                            :</label>
                                    </div>
                                    <div class="col-7">
                                        <input class="form-control" id="FormPasswdConfirm" type="password" name="password-confirm">
                                    </div>
                                </div>
                            </div>

                            <div id="champSchéma" class="champ" style="display: none;">
                                <div>blabla</div>
                            </div>

                            <div id="champCode" class="champ" style="display: none;">
                                <div class="row align-items-center mt-4">
                                    <div class="col-5 text-center">
                                        <label for="codeField" class="form-label pe-none">Code:</label>
                                    </div>
                                    <div class="col-7">
                                        <input class="form-control" id="codeField" type="text" name="code">
                                    </div>
                                </div>
                                <div class="row align-items-center mt-4">
                                    <div class="col-5 text-center">
                                        <label for="codeFieldConfirm" class="form-label pe-none">Confirmer le code :</label>
                                    </div>
                                    <div class="col-7">
                                        <input class="form-control champ-form" id="codeFieldConfirm" type="text" name="code-confirm">
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