<?php $title = "Page Accueil Elève";
$bsIcons = true
?>


<?php ob_start(); ?>

<div class="container mt-5">
    <div class="row mb-4">
        <h2 class="col-12">Bienvenue <?=htmlentities($student->firstName)?> !</h2>
    </div>
    <div class="container-current mb-4">
        <div class="row align-items-center">
            <p class="col-3 m-0 fs-4">Liste des fiches courantes</p>
            <hr class="border m-auto col-9 border-3 border-dark opacity-75" />
        </div>
        <div class="row">
            <?php ?>
                <div class="col-3 text-center">
                    <i class="bi bi-file-earmark-text" style="font-size: 8rem;"></i>
                    <h4 class="col-12">Session <?=htmlentities($currentForm->form->idSession)?></h4>
                    <a href="fiche-<?=$currentForm->form->numero?>">
                        <button type="button" class="btn btn-dark col-6 mt-2"><i class="bi bi-pencil-square"></i></button>
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
                        <h4>Session <?=htmlentities($finish->form->idSession)?></h4>
                        <a href="fiche-<?=$finish->form->idSession?>">
                            <button type="button" class="btn btn-dark col-6 mt-2"><i class="bi bi-eye"></i></button>
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