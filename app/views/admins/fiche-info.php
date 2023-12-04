<?php
$title = "Page Information fiche";
$bsIcons = true;
$scripts = "<script src='/assets/js/fiche_info.js' type='module'></script>";
?>

<?php ob_start(); ?>
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
                        Session <?= $form[0]["IDSession"] ?> -
                        <?= $student["nom"] ?>
                        <?= $student["prenom"] ?>
                    </h4>
                </div>
                <div class="col-12 mt-2">
                    <h4> Création : <?= $form[0]["date_creation"] ?></h4>
                </div>
                <div class="col-12 my-2">
                    <h4> Dernière modification : <?= $form[0]["date_last_modif"] ?></h4>
                </div>
            </div>
        </div>
    </div>

    <div class="row">
        <?php $counter = 1; ?>
        <?php foreach ($coms as $com) { ?>
            <div class="col-12 mb-3">
                <div class="form-floating">
                    <div class="form-control" id="comment<?= $counter ?>">
                        <?= $com['Text'] ?>
                    </div>
                    <label for="comment<?= $counter ?>">Commentaire <?= $counter ?></label>
                </div>
            </div>
            <?php $counter++; ?>
        <?php } ?>
    </div>

    <div class="row mt-5">
        <?php foreach ($pictures as $picture) { ?>
            <div class="col-md-3 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <i class="bi bi-image" style="font-size: 5rem;"></i>
                        <h5 class="card-title mt-3"><?= $picture["name"] ?></h5>
                    </div>
                </div>
            </div>
        <?php } ?>
    </div>
</div>

<div class="row text-center">
    <div class="col-12" data-note="<?= $form[0]["note"] ?>" style="font-size: 3rem;">
        <i class="bi bi-emoji-angry me-2 emoji emoji-angry"></i>
        <i class="bi bi-emoji-frown me-2 emoji emoji-frown"></i>
        <i class="bi bi-emoji-neutral me-2 emoji emoji-neutral"></i>
        <i class="bi bi-emoji-smile me-2 emoji emoji-smile"></i>
        <i class="bi bi-emoji-laughing me-2 emoji emoji-laughing"></i>
    </div>
</div>

<?php $content = ob_get_clean();
require("../app/views/layout.php");
?>
