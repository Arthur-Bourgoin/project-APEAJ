<?php

$title = "Page de connexion";
$scripts = "<script src='/assets/js/connexion.js' type='module'></script>";
$bsIcons = true?>

<?php ob_start(); ?>

<div class="container mt-5">
    <div class="row mb-5 align-items-center">
        <h1 class="col-md-11 col-5">Sélectionner un profil</h1>
        <button class="btn btn-dark col-1 text-white" id="btn-admin" data-bs-toggle="modal" data-bs-target="#modalConnexionAdmin">Admin</button>
    </div>
    <div class="row mb-3 align-items-centerd-flex justify-content-around">   
    <?php 
    foreach ($students as $student) { 
        if($student["typemdp"] == "code") {
            $target = "modalConnexionCode";
        }else if($student["typemdp"]=="texte"){
            $target="modalConnexionTexte";
        }
        ?>
        <div class="card mb-4 mx-2 col-lg-3 col-md-4 col-6 border-dark" data-typemdp="<?= $student["typemdp"] ?>" data-login-student="<?= $student["login"] ?>" data-bs-toggle="modal" data-bs-target="#<?=$target?>">
            <img src="<?= htmlentities($student["picture"])?>" class="img-thumbnail border-0 mt-4" alt="Photo de l\'étudiant 1">
            <div class="card-body text-center">'
                <h5 class="card-title"><?=htmlentities($student["nom"])?></h5>
                <p class="card-text"><?= htmlentities($student["prenom"])?></p>
            </div>
        </div>
    <?php } ?>
    </div>
</div>

<!-- Modal de connexion de type "texte" -->
<div class="modal fade" id="modalConnexionTexte" tabindex="-1" role="dialog" aria-labelledby="modalConnexionTexteLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalConnexionTexteLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <!-- Photo de l'étudiant -->
                <img id="etudiantPhoto" class="img-thumbnail" style="max-width: 50%; max-height: 50%;" alt="Photo de l'étudiant">
                <h5 id="etudiantNom" class="card-title"></h5>
                <p id="etudiantPrenom" class="card-text"></p>
                <form id="formTexte">
                    <div class="form-group d-flex flex-column align-items-center">
                        <div class="col-10">
                            <div class="input-group">
                                <span class="input-group-text" style="height: 38px;"><i class="bi bi-lock-fill"></i></span>
                                <input type="password" class="form-control mb-4" id="mdpTexte" placeholder="Votre mot de passe" aria-label="Username" aria-describedby="addon-wrapping">
                                <button type="button" id="btn-show-text" class="btn btn-show btn-dark text-white" style="height: 38px;"><i class="bi bi-eye"></i></button>
                            </div>
                        </div>
                    </div>
                    <button type="submit" class="btn col-4 btn-dark text-white me-2">Se connecter</button>
                    <button type="button" class="btn col-4 btn-dark text-white" data-bs-dismiss="modal" aria-label="Close">Annuler</button>
                </form>
            </div>
        </div>

    </div>
</div>

<!-- Modal de connexion de type "code numérique" -->
<div class="modal fade" id="modalConnexionCode" tabindex="-1" role="dialog" aria-labelledby="modalConnexionCodeLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalConnexionCodeLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <!-- Photo de l'étudiant -->
                <img id="etudiantPhotoCode" class="img-thumbnail mb-3" style="max-width: 50%; max-height: 50%;" alt="Photo de l'étudiant">
                <h5 id="etudiantNomCode" class="card-title"></h5>
                <form id="formCode">
                    <div class="form-group text-center">
                        <div class="form-group d-flex flex-column align-items-center">
                            <div class="col-6">
                                <div class="input-group">
                                    <span class="input-group-text" style="height: 38px;"><i class="bi bi-lock-fill"></i></span>
                                    <input type="password" class="form-control pe-none mb-4 text-center" id="codeNumerique" placeholder="Code numérique" maxlength="6" />
                                    <button type="button" id="btn-show-code" class="btn btn-show btn-dark text-white" style="height: 38px;"><i class="bi bi-eye"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 mb-2">
                            <button type="button" class="btn-chiffre col-3 btn btn-dark text-white btn-block">1</button>
                            <button type="button" class="btn-chiffre col-3 btn btn-dark text-white btn-block">2</button>
                            <button type="button" class="btn-chiffre col-3 btn btn-dark text-white btn-block">3</button>
                        </div>
                        <div class="col-12 mb-2">
                            <button type="button" class="btn-chiffre col-3 btn btn-dark text-white btn-block">4</button>
                            <button type="button" class="btn-chiffre col-3 btn btn-dark text-white btn-block">5</button>
                            <button type="button" class="btn-chiffre col-3 btn btn-dark text-white btn-block">6</button>
                        </div>
                        <div class="col-12 mb-2">
                            <button type="button" class="btn-chiffre col-3 btn btn-dark text-white btn-block">7</button>
                            <button type="button" class="btn-chiffre col-3 btn btn-dark text-white btn-block">8</button>
                            <button type="button" class="btn-chiffre col-3 btn btn-dark text-white btn-block">9</button>
                        </div>
                        <div class="col-md-12 mb-2">
                            <button type="button" class="btn-clear btn-danger col-3 btn btn-block"><i class="bi bi-eraser text-white"></i></button>
                            <button type="button" class="btn-chiffre col-3 btn btn-dark text-white ml-2 mr-2 btn-block">0</button>
                            <button type="submit" class="btn btn-success col-3 btn-block"><i class="bi bi-check text-white"></i></button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

<!--Modal de connexion Amdin-->
<div class="modal fade" id="modalConnexionAdmin" tabindex="-1" role="dialog" aria-labelledby="modalConnexionAdminLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="modalConnexionTexteLabel"></h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body text-center">
                <!-- Photo de l'étudiant -->
                <img id="AdminPhoto" class="img-thumbnail" style="max-width: 50%; max-height: 50%;" src="/assets/images/Utilisateurs/user.png" alt="Icone de l'admint">
                <h5 id="etudiantNom" class="card-title"></h5>
                <p id="etudiantPrenom" class="card-text"></p>
                <form id="formAdmin">
                    <div class="form-group d-flex flex-column align-items-center">
                        <div class="row col-10">
                            <div class="input-group">
                                <span class="input-group-text" style="height: 38px;"><i class="bi bi-person-fill"></i></span>
                                <input type="texte" class="form-control mb-4" id="loginAdmin" placeholder="Votre login" aria-label="Username" aria-describedby="addon-wrapping">
                            </div>  
                        </div>
                        <div class="row col-10">
                            <div class="input-group">
                                <span class="input-group-text" style="height: 38px;"><i class="bi bi-lock-fill"></i></span>
                                <input type="password" class="form-control mb-4" id="mdpAdmin" placeholder="Votre mot de passe" aria-label="Username" aria-describedby="addon-wrapping">
                                <button type="button" id="btn-show-admin" class="btn btn-dark text-white" style="height: 38px;"><i class="bi bi-eye"></i></button>
                            </div>
                        </div>    
                    </div>
                    <button type="submit" class="btn btn btn-dark text-white">Se connecter</button>
                </form>
            </div>
        </div>
    </div>
</div>


<?php 
$content = ob_get_clean();
require("layout.php");