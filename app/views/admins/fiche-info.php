<?php
$title = "Page Information fiche";
$bsIcons = true;
$scripts = "<script src='/assets/js/admin/fiche-info.js' type='module'></script>
<script src='/assets/js/account.js' type='module'></script>
<script src='https://cdn.jsdelivr.net/npm/chart.js'></script>";
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
<div class="container">
    <div class="row">
        <div class="d-flex justify-content-end align-items-center">
            <div class="d-flex align-items-center ">
                <a href="/disconnect"><button class="btn btn-danger"><i class="bi bi-power me-2"></i>Se
                        déconnecter</button></a>
                <button class="btn" data-bs-toggle="modal" data-bs-target="#profileConsultation">
                    <i class="bi bi-person-circle " style="font-size: 3rem;"></i>
                </button>
            </div>
        </div>
    </div>
    <div class="row mb-5">
        <div class="col-3 text-center">
            <i class="bi bi-file-earmark-text text-primary" style="font-size: 8rem;"></i>
        </div>
        <div class="col-9">
            <div class="row align-items-center">
                <div class="col-12 my-2">
                    <h4>
                        <?= !empty($form->session->wording) ? htmlentities($form->session->wording) : "" ?> -
                        <?= !empty($student->lastName) ? htmlentities($student->lastName) : "" ?>
                        <?= !empty($student->firstName) ? htmlentities($student->firstName) : ""?>
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
            </div>
        </div>
    </div>
    <?php if(!empty($form->form) && $form->form->finish == 0){ ?>
    <div class="mb-2" >
        <form action="<?= $_SERVER["REQUEST_URI"] ?>" method="POST">
            <button type="submit" class="btn btn-primary btn-finish-form "> <i class="bi bi-x-lg"></i>Marquer la fiche comme finie</button>
            <input type="hidden" name="action" value="finishForm">
            <input type="hidden" name="idStudent" value="<?= $student->idUser ?>">
            <input type="hidden" name="numero" value="<?= $form->form->numero ?>">
        </form>
    </div>
    <?php }
    ?>
        <?= App\Class\Feedback::getMessage() ?>
    <div class="row">
        <?php 
        if(!empty($form->comments) && is_array($form->comments))
            foreach ($form->comments as $com) {
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

        <?php 
        if(!empty($form->pictures)){  
            foreach ($form->pictures as $picture) { ?>
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
        <?php }}
         ?>
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
    </div>
    <?php
    require("../app/views/modalAccount.php");
    ?>
    <script>
        const commentsTab = <?= json_encode($form->comments) ?>;
        console.log(commentsTab);
    </script>
    <?php $content = ob_get_clean();
    require("../app/views/layout.php");
    ?>