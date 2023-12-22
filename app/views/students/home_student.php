<?php $title = "Page Accueil Elève";
$bsIcons = true
?>


<?php ob_start(); ?>

<div class="container mt-5">
    <div class="row mb-4">
        <h1>Bienvenue <?=htmlentities($student->firstName)?> !</h1>
        <div class="d-flex justify-content-end align-items-end">
            <a href="/disconnect">
                <button class="btn btn-danger">
                    <i class="bi bi-power me-2"></i>Se déconnecter 
                </button>
            </a>
        </div>
    </div>
    <div class="container-current mb-4">
        <div class="row align-items-center">
            <p class="col-2 m-0 fs-4">Fiche courante</p>
            <hr class="border m-auto col-10 border-3 border-dark opacity-75" />
        </div>
        <div class="row">
            <?php ?>
                <div class="col-3 text-center">
                    <i class="bi bi-file-earmark-text" style="font-size: 8rem;"></i>
                    <h4 class="col-12"><?=htmlentities($currentForm->session->wording)?></h4>
                    <a href="fiche-<?=$currentForm->form->numero?>">
                        <button type="button" class="btn btn-primary col-6 mt-2"><i class="bi bi-pencil-square"></i></button>
                    </a>
                </div>
            <?php?>
        </div>
    </div>
    <div class="container-finish mb-5 mt-2">
        <div class="row align-items-center">
            <p class="col-3 m-0 fs-4">Liste des fiches terminées</p>
            <hr class="border m-auto col-9 border-3 border-dark opacity-75" />
        </div>
        <div class="row">
            <?php foreach ($finishedForms as $finish) { ?>
                <div class="col-3 text-center">
                    <i class="bi bi-file-earmark-text" style="font-size: 8rem;"></i>
                    <div>
                        <h4><?=htmlentities($finish->session->wording)?></h4>
                        <a href="fiche-<?=$finish->form->idSession?>">
                            <button type="button" class="btn btn-primary col-6 mt-2"><i class="bi bi-eye"></i></button>
                        </a>
                    </div>
                </div>
            <?php } ?>
        </div>
    </div>
</div>
<?php 
$content = ob_get_clean();
require("../app/views/layout.php");