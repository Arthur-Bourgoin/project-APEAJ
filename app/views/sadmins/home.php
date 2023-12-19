<?php
$bsIcons = true;
$title = "Accueil";
$scripts = "<script src='./assets/js/sadmin/home.js' type='module'></script>";
define("PATH", "/assets/images/formations/");
ob_start();
?>

<div class="container">
    <div class="row mb-3">
        <div class="d-flex justify-content-between align-items-center p-0">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newTraining"> 
                <i class="bi bi-file-plus me-2"></i>Ajouter une formation 
            </button>
            <div class="d-flex align-items-center">
                <form action="<?= $_SERVER["REQUEST_URI"] ?>" method="POST">
                    <input type="hidden" name="action" value="disconnect">
                    <button type="submit" class="btn btn-danger">
                        <i class="bi bi-power me-2"></i>Se déconnecter 
                    </button>
                </form>
                <button class="btn p-0 ms-3">
                    <i class="bi bi-person-circle" style="font-size: 2.5rem"></i>
                </button>
            </div>
        </div>
    <?php
    switch ($error) {
        case 1 :
            echo '<div class="alert alert-danger mt-3 mb-1" role="alert">Une erreur s\'est produite lors de l\'initialisation de la page.</div>'; break;
        case 2 :
            echo '<div class="alert alert-danger mt-3 mb-1" role="alert">Ajout impossible d\'une formation impossible, les données ne sont pas completes.</div>'; break;
        case 3 : 
            echo '<div class="alert alert-danger mt-3 mb-1" role="alert">Une erreur s\'est produite lors de l\'ajout d\'une formation</div>'; break;
        case 8:
            echo '<div class="alert alert-danger mt-3 mb-1" role="alert">Une erreur s\'est produite lors de la suppression de la formation.</div>'; break;
        case 5 : 
            echo '<div class="alert alert-danger mt-3 mb-1" role="alert">Ajout impossible d\'un utilisateur, les valeurs rentrées ne sont pas valides.</div>'; break;
        case 6 :
            echo '<div class="alert alert-danger mt-3 mb-1" role="alert">Une erreur s\'est produite lors de l\'ajout d\'un utilisateur à une formation.</div>'; break;
    }

    switch ($success) {
        case 1 :
            echo '<div class="alert alert-success mt-3 mb-1" role="alert">Ajout de la formation enregistré.</div>'; break;
        case 2 :
            echo '<div class="alert alert-success mt-3 mb-1" role="alert">Suppression enregistrée.</div>'; break;
        case 3 :
            echo '<div class="alert alert-success mt-3 mb-1" role="alert">Ajout de l\'utilisateur enregistré.</div>'; break;
    }
    ?>
    </div>

    
    <!-- Affichge grand écran-->
    <div class ="">
        <?php
            if(is_array($trainings)) {
                foreach ($trainings as $training) {?>
                    <div class="row border mb-3">
                        <div class="col-4 my-auto">
                            <div class="text-center">
                                <img src="<?= PATH . 'ampoules.jpg' ?>" class="border w-100">
                            </div>
                        </div>
                        <div class="col-8 d-flex flex-column justify-content-evenly py-3">
                            <p class=" fs-3 fw-bold text-center"><?= htmlentities($training->wording)?></p>
                            <p class="text-center fs-5 d-none d-md-block"><?= htmlentities($training->description)?></p>                            
                            <div class="d-flex justify-content-evenly" >  
                                <button type="button" class="btn-add-user btn btn-primary" data-bs-toggle="modal" data-bs-target="#newUser" data-id-training="<?= $training->idTraining ?>">
                                    <i class="bi bi-person-plus-fill" style="font-size: 1.5rem"></i>
                                </button>
                                <form action="<?= $_SERVER["REQUEST_URI"] ?>" method="POST">
                                    <input type="hidden" name="action" value="deleteTraining">
                                    <input type="hidden" name="idTraining" value="<?= $training->idTraining ?>">
                                    <button type="submit" class="btn btn-primary btn-removed">
                                        <i class="bi bi-trash-fill" style="font-size: 1.5rem"></i>
                                    </button>
                                </form>
                                <a href="/formation-<?=htmlentities($training->idTraining)?>">
                                    <button class=" btn btn-primary">
                                        <i class="bi bi-eye" style="font-size: 1.5rem"></i>
                                    </button>
                                </a>                              
                            </div>                                
                        </div>
                    </div>
                <?php
                }
            }
            ?>
    </div>

    <!-- Modal ajout utilisateur-->
    <div class="modal fade" id="newUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="newUserLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="<?= $_SERVER ["REQUEST_URI"]?>" method="POST">
                <input type="hidden" name="action" value="addUser">
                <input type="hidden" name="idTraining">
                    
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newUserLabel">Ajouter utilisateur</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <div class="col-4">
                                <!--Rajouter et changer les images -->
                                <label for="inputImgUser">
                                    <img id="imgUser" src="<?= PATH . 'ampoules.jpg' ?>" class="w-100 border" alt="Image de l'utilisateur">
                                </label>
                                <input id="inputImgUser" type="file" class="d-none" name="picture">
                            </div>

                            <!-- Seletection du nom et du prenom-->
                            <div class="col-8 d-flex flex-column justify-content-between">
                                <div class="mb-3">
                                    <label for="inputLastName">Nom</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person-vcard"></i></span>
                                        <input id="inputLastName" type="text" class="form-control" name="lastName">
                                    </div>
                                </div>

                                <div class="mb-3">
                                    <label for="inputFirstName">Prénom</label>
                                    <div class="input-group">
                                        <span class="input-group-text"><i class="bi bi-person-vcard"></i></span>
                                        <input id="inputFirstName" type="text" class="form-control" name="firstName">
                                    </div>
                                </div>
                            </div>
                            
                            <div class="col-12 mt-3">
                                <label for="inputTypePwd" class="form-label">Type de mot de passe</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-lock"></i></span>
                                    <select class="form-select" id="inputTypePwd" name="typePwd">
                                        <option value="1">Texte</option>
                                        <option value="2">Code</option>
                                        <option value="3">Schéma</option>
                                    </select>
                                </div>
                            </div>

                            <div id="champText">
                                <div class="col-12 mt-3">
                                    <label for="inputPwd" class="form-label">Mot de passe</label>
                                    <div class="input-group">
                                        <input id="inputPwd" type="password" class="form-control input-pwd" name="pwd">
                                        <span role="button" class="input-group-text"><i class="bi bi-eye"></i></span>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="inputConfirmPwd" class="form-label">Confirmation du mot de passe</label>
                                    <div class="input-group">
                                        <input id="inputVerifPwd" type="password" class="form-control input-pwd" name="verifPwd">
                                        <span role="button" class="input-group-text"><i class="bi bi-eye"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div id="champCode">
                                <div class="col-12 mt-3">
                                    <label for="inputPwd" class="form-label">Code</label>
                                    <div class="input-group">
                                        <input id="inputPwd" type="password" class="form-control input-pwd" name="pwd" pattern="[0-9]{4,6}">
                                        <span role="button" class="input-group-text"><i class="bi bi-eye"></i></span>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <label for="inputConfirmPwd" class="form-label">Confirmation du code</label>
                                    <div class="input-group">
                                        <input id="inputVerifPwd" type="password" class="form-control input-pwd" name="verifPwd" pattern="[0-9]{4,6}">
                                        <span role="button" class="input-group-text"><i class="bi bi-eye"></i></span>
                                    </div>
                                </div>
                            </div>
                            <div id="champSchema">
                                <div class="col-12 mt-3">
                                    schéma
                                </div>
                                <div class="col-12 mt-3">
                                    confirmation schéma
                                </div>
                            </div>
                            <!-- Selection du type d'utilisateur -->
                            <div class="col-12 my-3">
                                <label class="form-label" for="inputRole">Rôle de l'utilisateur</label>
                                <div class="input-group">
                                    <span class="input-group-text"><i class="bi bi-mortarboard"></i></span>
                                    <select class="form-select" id="inputRole" name="role">
                                        <option value="student">Élève</option>
                                        <option value="educator">Educateur</option>
                                        <option value="educator-admin">Educateur administrateur</option>
                                        <option value="CIP">CIP</option>
                                    </select>
                                </div>
                            </div>
                            <div class="modal-footer text-center">
                                <button type="button" class="btn btn-danger me-2" data-bs-dismiss="modal">
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



    <!-- Add Training-->
    <div class="modal fade" id="newTraining" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="newTrainingLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="<?= $_SERVER ["REQUEST_URI"]?>" method="POST">
                <input type="hidden" name="action" value="addTraining">

                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newTrainingLabel">Ajouter formation</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">     
                        <div class="row">
                            <!--Selection de l'image -->
                            <div class="col-4">
                                <label for="inputImgTraining">
                                    <img id="imgTraining" src="<?= PATH . 'ampoules.jpg' ?>" class="w-100 border border-black border-2 rounded" alt="Photo de la formation">
                                </label>
                                <input id="inputImgTraining" type="file" class="d-none" name="imgTraining">
                            </div>   
                            <div class="col-8">
                                <div class="">
                                    <label for="inputName" class="form-label">Nom de la formation</label>
                                    <input id="inputName" type="text" class="form-control" name="wording">
                                </div>
                                <div class="">
                                    <label for="inputLevel" class="form-label">Niveau de la formation</label>
                                    <input id="inputLevel" type="text" class="form-control" name="qualifLevel">
                                </div>
                            </div>
                            <div class="col-12 my-3">
                                <label for="inputDescription" class="form-label">Description Formation</label>                                        
                                <textarea class="form-control" id="inputDescription" rows="3" name="description" ></textarea>
                            </div>
                
                            <div class="modal-footer">
                                <button type="button" class="me-3 btn btn-danger" data-bs-dismiss="modal">
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
       
</div>

<?php
$content = ob_get_clean(); //On récupère le contenu bufferisé

require("../app/views/layout.php");