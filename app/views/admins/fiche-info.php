<?php
$title = "Page Information fiche";
$bsIcons = true;
$scripts = "<script src='/assets/js/fiche_info.js' type='module'></script>";
?>

<?php ob_start(); ?>
<style>
    #pictures .div-img {
        height: 100px;
    }
</style>
<div class="container my-5">
    <div class="row mb-5">
        <div class="col-3 text-center">
            <i class="bi bi-file-earmark-text text-primary" style="font-size: 8rem;"></i>
        </div>
        <div class="col-9">
            <div class="row align-items-center">
                <div class="col-12">
                    <h3>Informations de la session :</h3>
                </div>
                <div class="col-12 my-2">
                    <h4>
                    <?= $form->session->wording ?> -
                        <?= $student->lastName ?>
                        <?= $student->firstName ?>
                    </h4>
                </div>
                <div class="col-12 mt-2">
                    <h4> Création :
                        <?= $form->form->creationDate ?>
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

    <div class="row">
        <?php foreach ($form->comments as $com) { ?>
            <div class="col-12 mb-3">
                <div class="d-flex align-items-center justify-content-between">
                    <div class="form-floating w-100">
                        <div class="form-control comment-container overflow-auto h-auto" id="<?= $com->idCommentForm ?>">
                            <span class="comment-text">
                                <?= $com->text ?>
                            </span>
                        </div>
                        <label for="<?= $com->idCommentForm ?>">
                            <?= $com->wording ?>
                        </label>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <button type="button" class="btn btn-primary mt-3 " data-bs-toggle="modal" data-bs-target="#ModalComs">
        Ajouter un commentaire
    </button>

    <div class="row mt-5" id="pictures">
        <?php foreach ($form->pictures as $picture) { ?>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <div class="div-img">
                            <img src="<?= $picture->path ?>" alt="Image" class="object-fit-contain mw-100 mh-100 ">
                        </div>
                        <h5 class="card-title mt-3">
                            <?= $picture->title ?>
                        </h5>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
    <button type="button" class="btn btn-primary mt-3 " data-bs-toggle="modal" data-bs-target="#ModalAddPicture">
        Ajouter une photo
    </button>
</div>

<div class="row text-center">
    <div class="col-12" data-note="<?= round(($form->form->educatorNote) / 4) ?>" style="font-size: 3rem;">
        <i class="bi bi-emoji-angry me-2 emoji emoji-angry"></i>
        <i class="bi bi-emoji-frown me-2 emoji emoji-frown"></i>
        <i class="bi bi-emoji-neutral me-2 emoji emoji-neutral"></i>
        <i class="bi bi-emoji-smile me-2 emoji emoji-smile"></i>
        <i class="bi bi-emoji-laughing me-2 emoji emoji-laughing"></i>
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
                    <div class=" col-12 ">
                        <label for="Formwording" class="form-label pe-none">Nom du commentaire</label>
                        <input class=" form-control" id="Formwording" name="wording">
                    </div>
                    <div class=" col-12 ">   
                    <label for="Formtext" class="form-label pe-none">Contenu</label>
                        <textarea class=" form-control" id="Formtext" name="text"></textarea>
                    </div>


            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                <button type="submit" class="btn btn-primary">Ajouter</button>
            </div>
            </form>
        </div>
    </div>
</div>

<?php $content = ob_get_clean();
require("../app/views/layout.php");
?>