<?php $title = "Suivi de l'étudiant";
$bsIcons = true;
$scripts ="<script src='/assets/js/account.js' type='module'></script>
<script src='https://cdn.jsdelivr.net/npm/chart.js'></script>";
ob_start(); ?>

<div class="container">
    <div class="row">
        <?php if(!empty($student)){ ?>
        <h2 class="text-center mt-3">
           Suivi de l'étudiant <?=htmlentities($student->lastName)?> <?=htmlentities($student->firstName)?> 
        </h2>
        <?php } ?>
        <div class="d-flex justify-content-end align-items-center">
            <div class="d-flex align-items-center ">
                <a href="/disconnect"><button class="btn btn-danger"><i class="bi bi-power me-2"></i>Se déconnecter</button></a> 
                <button class="btn" data-bs-toggle="modal" data-bs-target="#profileConsultation">
                    <i class="bi bi-person-circle " style="font-size: 3rem;"></i> 
                </button>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-3 mt-3 mr-3 ">
            <img src="<?= $student->picture ?>" class="img-thumbnail" alt="Photo de l\'étudiant 1">
        </div>
        <div class="col-9">
            <div class="row mt-3 ms-3 align-items">
            <?php if (!empty($student)) { ?>
                <div class="col-12 my-3">
                    <h2>
                        <?= htmlentities($student->lastName) ?>
                        <?= htmlentities($student->firstName) ?>
                    </h2>
                </div>
                <div class="col-12 my-3">
                    <h5>
                        login:
                        <?= htmlentities($student->login) ?>
                    </h5>
                </div>
                <?php } ?>
                <div class="col-12 mt-4">
                    <?= App\Class\Feedback::getMessage() ?>
                </div>
            </div>
        </div>
    </div>
    <div class="row justify-content-center mt-2">
        <div class="col-12 col-lg-6">
            <canvas id="graphiqueNoteMoyenne" width="400" height="300" ></canvas>
        </div> 
        <div class="col-12 col-lg-6" mt-2>
            <canvas id="graphiqueNiveauMoyen" width="400" height="300" ></canvas>
        </div> 
    </div>
</div>


<div class="modal fade" id="profileConsultation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="UpdateUserLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form enctype="multipart/form-data" action="<?= $_SERVER["REQUEST_URI"] ?>" method="POST">
            <input type="hidden" id="idCurrentUser" name="idUser" value="<?= $currentUser->idUser ?>" />
            <input type="hidden" name="action" value="updateAccount" />
            <input type="hidden" name="MAX_FILE_SIZE" value="300000" />
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newUserLabel">Modifier utilisateur</h5>
                    <button type="button" class="btn-close-acc" data-bs-dismiss="modal" aria-label="Close"></button>
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
                                <select class="form-select selectTypePwd" id="CurrentUserinputTypePwd" name="typePwd">
                                    <option value="1" <?= $currentUser->typePwd === 1 ? 'selected' : "" ?>> Texte </option>
                                    <option value="2" <?= $currentUser->typePwd === 2 ? "selected" : "" ?>> Code </option>
                                    <option value="3" <?= $currentUser->typePwd === 3 ? "selected" : "" ?>> Schéma
                                    </option>
                                </select>
                            </div>
                        </div>
                        <div class="textField">
                            <div class="col-12 mt-3">
                                <label for="inputPwd" class="form-label">Mot de passe</label>
                                <div class="input-group">
                                    <input id="CurrentUserinputPwd" type="password" class="form-control input-pwd"
                                        name="pwd">
                                    <span role="button" class="input-group-text"><i class="bi bi-eye"></i></span>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <label for="inputConfirmPwd" class="form-label">Confirmation du mot de passe</label>
                                <div class="input-group">
                                    <input id="CurrentUserinputVerifPwd" type="password" class="form-control input-pwd"
                                        name="verifPwd">
                                    <span role="button" class="input-group-text"><i class="bi bi-eye"></i></span>
                                </div>
                            </div>
                        </div>
                        <div class="codeField">
                            <div class="col-12 mt-3">
                                <label for="inputPwd" class="form-label">Code</label>
                                <div class="input-group">
                                    <input id="CurrentUserinputCode" type="password" class="form-control input-pwd"
                                        name="pwd" pattern="[0-9]{4,6}">
                                    <span role="button" class="input-group-text"><i class="bi bi-eye"></i></span>
                                </div>
                            </div>
                            <div class="col-12 mt-3">
                                <label for="CurrentUserinputCode" class="form-label">Confirmation du code</label>
                                <div class="input-group">
                                    <input id="inputVerifPwd" type="password" class="form-control input-pwd"
                                        name="verifPwd" pattern="[0-9]{4,6}">
                                    <span role="button" class="input-group-text"><i class="bi bi-eye"></i></span>
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
     // Récupération des données PHP dans des variables JavaScript
 const levelsData = <?= json_encode($tabLevels) ?>;
 const notesData = <?= json_encode($tabNotes) ?>;
 const tablink = <?=json_encode($tablink) ?>;
 // Récupération du contexte pour les graphiques
 const levelChartCanvas = document.querySelector('#graphiqueNiveauMoyen').getContext('2d');
 const noteChartCanvas = document.querySelector('#graphiqueNoteMoyenne').getContext('2d');

 // Création des graphiques
 const levelChart = new Chart(levelChartCanvas, {
     type: 'line',
     data: {
         labels: Object.keys(levelsData),
         datasets: [{
             label: 'Niveau Moyen',
             data: Object.values(levelsData),
             fill: false,
             borderColor: 'rgba(75, 192, 192, 1)',
             tension: 0.1
         }]
     },
     options: {

         responsive: true,
         plugins: {
             title: {
                 display: true,
                 text: 'Évolution du niveau moyen des éléments '
             }
         },
         onClick: (event, elements) => {
            console.log("clic");
            if (elements.length > 0) {
                const index = elements[0].index;
                const dateClicked = Object.keys(levelsData)[index];
                const url = tablink[dateClicked];
                if (url) {
                    window.location.href = url;
                }
            }
        }
     }
 });

 const noteChart = new Chart(noteChartCanvas, {
     type: 'line',
     data: {
         labels: Object.keys(notesData),
         datasets: [{
             label: 'Note Moyenne',
             data: Object.values(notesData),
             fill: false,
             borderColor: 'rgba(255, 99, 132, 1)',
             tension: 0.1
         }]
     },
     options: {
         responsive: true,
         plugins: {
             title: {
                 display: true,
                 text: 'Évolution de la note moyenne des commentaires'
             }
         },
         onClick: (event, elements) => {
            console.log("clic");
            if (elements.length > 0) {
                const index = elements[0].index;
                const dateClicked = Object.keys(levelsData)[index];
                const url = tablink[dateClicked];
                if (url) {
                    window.location.href = url;
                }
            }
        }
     }
 });
     
</script>

    <?php $content = ob_get_clean();
require("../app/views/layout.php");