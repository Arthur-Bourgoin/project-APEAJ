<?php
$title = "Page Information fiche";
$bsIcons = true;
$scripts = "<script src='/assets/js/admin/fiche-info.js' type='module'></script>
<script src='/assets/js/CurrentUser.js' type='module'></script>";
define("PATH", "/assets/images/pictures/");
?>

<?php ob_start(); ?>
<style>
    #pictures .div-img {
        height: 100px;
    }

    .comment-container:hover {
        background-color: lightgray;
        cursor: pointer;
    }
</style>
<div class="container position-relative">
<div class="col-lg-2 position-absolute top-0 end-0">
    <a href="/disconnect"><button class="btn btn-danger"><i class="bi bi-power me-2"></i>Se déconnecter</button></a>  
    <i class="bi bi-person-circle text-black" style="font-size: 3rem;" data-bs-toggle="modal"
            data-bs-target="#profileConsultation"></i>
    </div>
    <div class="row mb-5">
        <div class="col-3 text-center">
            <i class="bi bi-file-earmark-text text-primary" style="font-size: 8rem;"></i>
        </div>
        <div class="col-9">
            <div class="row align-items-center">
                <div class="col-12 my-2">
                    <h4>
                        <?= $form->session->wording ?> -
                        <?= $student->lastName ?>
                        <?= $student->firstName ?>
                    </h4>
                </div>
                <div class="col-12 mt-2">
                    <h4> Création :
                        <?php
                        $date = new DateTime($form->form->creationDate);
                        echo $date->format('d m Y H:i');
                        ?>
                    </h4>
                </div>
                <!---<div class="col-12 my-2">
                    <h4> Dernière modification :
                    </h4>
                </div>
                ---->
            </div>
        </div>
    </div>
    <?php
    switch ($error) {
        case 1:
            echo "<div class = 'alert alert-danger'> Les données ne sont pas valides </div>";
            break;
        case 2:
            echo "<div class = 'alert alert-danger'> Une erreur s'est produite lors de l'affichage </div>";
            break;
        case 3:
            echo "<div class = 'alert alert-danger'> Vous ne pouvez modifier ou supprimer que les commentaires dont vous êtes l'auteur </div>";
            break;
        case 4:
            echo "<div class = 'alert alert-danger'> Informations de la photo incorrectes </div>";
            break;
        case 5:
            echo "<div class = 'alert alert-danger'> Photo non renseignée </div>";
            break;
        case 6:
            echo "<div class = 'alert alert-danger'> Erreur lors de la suppression!  </div>";
            break;
        case 7:
            echo "<div class = 'alert alert-danger'> Erreur: fichier à supprimer non trouvé  </div>";
            break;
        case 10:
            echo "<div class = 'alert alert-danger'> Erreur lors du téléchargement du fichier  </div>";
            break;
        case 102:
            echo "<div class = 'alert alert-danger'> L'image n'est pas renseignée ou le fichier n'est pas une image ! </div>";
            break;
    }
    switch ($success) {
        case 1:
            echo "<div class = 'alert alert-success'> Ajout du commentaire réussi </div>";
            break;
        case 2:
            echo "<div class = 'alert alert-success'> Modification du commentaire réussi </div>";
            break;
        case 3:
            echo "<div class = 'alert alert-success'> Supression du commenttaire réussi </div>";
            break;
        case 4:
            echo "<div class = 'alert alert-success'> Ajout d'une photo réussi </div>";
            break;
        case 5:
            echo "<div class = 'alert alert-success'> Suprression de la photo réussi </div>";
            break;
        case 12:
            echo "<div class = 'alert alert-success'> Modification profile réussie ! </div>";
            break;
    }
    ?>
    <div class="row">
        <?php foreach ($form->comments as $com) {
            echo $com->getTemplateComment();
        } ?>
    </div>
    <?php
    if (!in_array($_SESSION["id"], array_column($form->comments, "idAuthor"))) { ?>
        <button type="button" class="btn btn-primary mt-3" data-bs-toggle="modal" data-bs-target="#ModalComs">
            <i class="bi bi-chat-left-text me-2"></i> Ajouter un commentaire
        </button>
        <?php
    } ?>
    <div class="row mt-5" id="pictures">

        <?php foreach ($form->pictures as $picture) { ?>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="div-img">
                            <img src="<?= PATH . $picture->path ?>" alt="Image" class="object-fit-contain mw-100 mh-100 ">
                        </div>
                        <h5 class="card-title mt-3">
                            <?= $picture->title ?>
                        </h5>
                        <form action="<?= $_SERVER["REQUEST_URI"] ?>" method="post"
                            class="position-absolute top-0 end-0 mt-2 me-2">
                            <input type="hidden" name="idPicture" value="<?= $picture->idPicture ?>">
                            <button type="submit" class=" btn btn-danger btn-delete-picture " name="action"
                                value="deletePicture">
                                <i class="bi bi-trash"></i>
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="col-md-3 col-sm-6 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <a href="#" data-bs-toggle="modal" data-bs-target="#NewPicture">
                        <i class="bi bi-plus-circle" style="font-size: 5rem;"></i>
                    </a>
                    <h5 class="card-title mt-3">
                        Ajouter une photo
                    </h5>
                </div>
            </div>
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
                        <input type="hidden" name="numero" value="<?= $form->form->numero ?>" />
                        <input type="hidden" name="lastUpdate" value="" />
                        <input type="hidden" name="audio" value="" />
                        <div class=" col-12 ">
                            <label for="Formwording" class="form-label pe-none">Nom du commentaire</label>
                            <input class=" form-control" id="Formwording" name="wording">
                        </div>
                        <div class=" col-12 ">
                            <label for="Formtext" class="form-label pe-none">Contenu</label>
                            <textarea class=" form-control" id="Formtext" name="text"></textarea>
                        </div>
                        <div class=" col-12 ">
                            <label for="formNote" class="form-label pe-none">Note:</label>
                            <input class=" form-control" id="formNote" name="note" pattern="[0-9]|1[0-9]|20"></input>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="admin" name="admin">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Visible uniquement par l'équipe
                                pédagogique
                                </input></label>
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
                    <h5 class="modal-title" id="AddComment">Modifier un commentaire</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form action="<?= $_SERVER["REQUEST_URI"] ?>" method="POST">
                        <input type="hidden" name="action" value="updateComment" />
                        <input type="hidden" id="idCommentForm" name="idCommentForm" value="" />
                        <input type="hidden" id="audio" name="audio" value="/chemin/test.mp3" />
                        <div class=" col-12 ">
                            <label for="formWording" class="form-label pe-none">Nom du commentaire</label>
                            <input class=" form-control" id="formWording" name="wording">
                        </div>
                        <div class=" col-12 ">
                            <label for="formText" class="form-label pe-none">Contenu</label>
                            <textarea class=" form-control" id="formText" name="text"></textarea>
                        </div>
                        <div class=" col-12 ">
                            <label for="formNote" class="form-label pe-none">Note:</label>
                            <input class=" form-control" id="formNote" name="note" pattern="[0-9]|1[0-9]|20"></input>
                        </div>
                        <div class="form-check form-switch">
                            <input class="form-check-input" type="checkbox" role="switch" id="admin" name="admin"
                                value="1">
                            <label class="form-check-label" for="flexSwitchCheckDefault">Visible uniquement par l'équipe
                                pédagogique
                                </input></label>
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

    <div class="modal fade" id="NewPicture" tabindex="-1" aria-labelledby="NewPicture" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="AddComment">Ajouter une Photo</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form enctype="multipart/form-data" action="<?= $_SERVER["REQUEST_URI"] ?>" method="POST">
                        <input type="hidden" name="action" value="addPicture" />
                        <div class="row">
                            <div class="col-3">
                                <label for="inputImgForm">
                                    <div class="d-flex align-items-center">
                                        <img id="imgForm" src="<?= PATH ?>default.png" class="img-thumbnail mx-3"
                                            alt="Image de l'intervention" style="width: 100px; height: 100px;">
                                    </div>

                                </label>

                                <input id="inputImgForm" type="file" class="d-none" name="path">
                            </div>
                            <div class=" col-6">
                                <label for="pictureTitle" class="form-label pe-none">Choisissez un titre</label>
                                <input class=" form-control" id="pictureTitle" name="title"></input>
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

        <div class="modal fade" id="profileConsultation" data-bs-backdrop="static" data-bs-keyboard="false"
            tabindex="-1" aria-labelledby="UpdateUserLabel" aria-hidden="true">
            <div class="modal-dialog">
                <form enctype="multipart/form-data" action="<?= $_SERVER["REQUEST_URI"] ?>" method="POST">
                    <input type="hidden" id="idCurrentUser" name="idUser" value="<?= $currentUser->idUser ?>" />
                    <input type="hidden" name="action" value="updateAccount" />
                    <input type="hidden" name="MAX_FILE_SIZE" value="300000" />
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="newUserLabel">Modifier utilisateur</h5>
                            <button type="button" class="btn-close-acc" data-bs-dismiss="modal"
                                aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            <div class="row">
                                <div class="col-4">
                                    <label for="inputImgCurrentUser">
                                        <img id="imgCurrentUser" src="<?= $currentUser->picture ?>" class="w-100 border"
                                            alt="Image de l'utilisateur">
                                    </label>
                                    <input id="inputImgCurrentUser" type="file" class="d-none" name="picture">
                                </div>

                                <div class="col-8 d-flex flex-column justify-content-between">
                                    <div class="mb-3">
                                        <label for="inputCurrentUserLastName">Nom</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-person-vcard"></i></span>
                                            <input id="inputCurrentUserLastName" type="text" class="form-control"
                                                name="lastName" value="<?= $currentUser->lastName ?>">
                                        </div>
                                    </div>

                                    <div class="mb-3">
                                        <label for="inputCurrentUserFirstName">Prénom</label>
                                        <div class="input-group">
                                            <span class="input-group-text"><i class="bi bi-person-vcard"></i></span>
                                            <input id="inputCurrentUserFirstName" type="text" class="form-control"
                                                name="firstName" value="<?= $currentUser->firstName ?>">
                                        </div>
                                    </div>
                                </div>

                                <div class="col-12 mt-3">
                                    <label for="inputTypePwd" class="form-label">Type de mot de passe</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                        <select class="form-select selectTypePwd" id="CurrentUserinputTypePwd"
                                            name="typePwd">
                                            <option value="1" <?= $currentUser->typePwd === 1 ? 'selected' : "" ?>> Texte
                                            </option>
                                            <option value="2" <?= $currentUser->typePwd === 2 ? "selected" : "" ?>> Code
                                            </option>
                                            <option value="3" <?= $currentUser->typePwd === 3 ? "selected" : "" ?>> Schéma
                                            </option>
                                        </select>
                                    </div>
                                </div>
                                <div class="textField">
                                    <div class="col-12 mt-3">
                                        <label for="inputPwd" class="form-label">Mot de passe</label>
                                        <div class="input-group">
                                            <input id="CurrentUserinputPwd" type="password"
                                                class="form-control input-pwd" name="pwd">
                                            <span role="button" class="input-group-text"><i
                                                    class="bi bi-eye"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label for="inputConfirmPwd" class="form-label">Confirmation du mot de
                                            passe</label>
                                        <div class="input-group">
                                            <input id="CurrentUserinputVerifPwd" type="password"
                                                class="form-control input-pwd" name="verifPwd">
                                            <span role="button" class="input-group-text"><i
                                                    class="bi bi-eye"></i></span>
                                        </div>
                                    </div>
                                </div>
                                <div class="codeField">
                                    <div class="col-12 mt-3">
                                        <label for="inputPwd" class="form-label">Code</label>
                                        <div class="input-group">
                                            <input id="CurrentUserinputCode" type="password"
                                                class="form-control input-pwd" name="pwd" pattern="[0-9]{4,6}">
                                            <span role="button" class="input-group-text"><i
                                                    class="bi bi-eye"></i></span>
                                        </div>
                                    </div>
                                    <div class="col-12 mt-3">
                                        <label for="CurrentUserinputCode" class="form-label">Confirmation du
                                            code</label>
                                        <div class="input-group">
                                            <input id="inputVerifPwd" type="password" class="form-control input-pwd"
                                                name="verifPwd" pattern="[0-9]{4,6}">
                                            <span role="button" class="input-group-text"><i
                                                    class="bi bi-eye"></i></span>
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
                                    <button type="button" class="btn btn-cancel-account btn-danger me-2"
                                        data-bs-dismiss="modal">
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
            const commentsTab = <?= json_encode($form->comments) ?>;
            console.log(commentsTab);
        </script>

        <?php $content = ob_get_clean();
        require("../app/views/layout.php");
        ?>