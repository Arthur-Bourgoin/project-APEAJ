<?php
$title = "Page Information session";
$bsIcons = true;
?>

<?php ob_start(); ?>
<div class="container">
    <div class="row">
        <div class="col-12 text-center mt-4">
            <h1>
                Session <?= htmlentities($id) ?>
            </h1>
        </div>
    </div>
    <div class="row  my-3">
        <div class="col-12">
            <div class="form-floating">
                <div class="form-control" id="descriptionTextArea" style="height: auto;" readonly><?= htmlentities($description[0]["Desc"]) ?></div>
                <label for="descriptionTextArea">Description</label>
            </div>
        </div>
    </div>
    <div class="row">
        <?php foreach ($fiches as $fiche) { ?>
            <div class="col-6 col-lg-3 col-md-4 col-sm-6 mb-4">
                <div class="card">
                    <div class="card-body text-center">
                        <a href="/etudiants/<?= htmlentities($fiche["NomEtu"]) ?>-<?= htmlentities($fiche["PrenomEtu"]) ?>-<?= htmlentities($fiche["IDstu"]) ?>/fiche-<?= htmlentities($fiche["ID"]) ?>">
                            <i class="bi bi-file-earmark-text" style="font-size: 5rem;"></i>
                        </a>
                        <h5 class="card-title mt-3"><?= htmlentities($fiche["NomEtu"] . " " . $fiche["PrenomEtu"]) ?></h5>
                    </div>
                </div>
            </div>
        <?php } ?>
        <div class="col-6 col-lg-3 col-md-4 col-sm-6 mb-4">
            <div class="card">
                <div class="card-body text-center">
                    <a href="/ajouter-fiche">
                        <i class="bi bi-plus-circle" style="font-size: 5rem;"></i>
                    </a>
                    <h5 class="card-title mt-3">Ajouter une fiche</h5>
                </div>
            </div>
        </div>
    </div>
</div>

<?php $content = ob_get_clean();
require("../app/views/layout.php");
?>
