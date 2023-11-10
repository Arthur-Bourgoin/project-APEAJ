<?php

$title = "Page d'accueil";
$script = '<script src="/assets/js/test.js" type="module" defer></script>';

ob_start(); ?>

<div class="container">
    <div class="row">
        <?php foreach($users as $user) { ?>
            <div class="col-12">
                <p><?= $user["nom"] . " " . $user["prenom"] ?></p>
            </div>
        <?php } ?>
    </div>
    <div class="row">
        <p class="fw-bold fs-2">Une image test:</p>
        <img src="/assets/images/apache.png">
    </div>
</div>

<?php
$content = ob_get_clean();

require("layout.php");