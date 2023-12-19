<?php
$bsIcons = true; //Si on veut utiliser les icones de bootstrap j'inclue le fichier nécessaire
$scripts = "<script src='/assets/js/formation.js' type='module'></script>";
$title = "Consultation Formation"; //Définir le titre de la page

ob_start(); //On bufferise l'affichage
?>
<div class="container mt-5">
  <?php
    switch ($error) {
        case 1 :
          echo '<div class="alert alert-danger my-3" role="alert">Une erreur s\'est produite lors de l\'initialisation de la page.</div>';
          $content = ob_get_clean();
          require("../app/views/layout.php");
          exit();
        case 2 :
          echo '<div class="alert alert-danger my-3" role="alert"> La formation n\'existe pas.</div>'; break;
        case 3:
          echo '<div class="alert alert-danger my-3" role="alert">Une erreur s\'est produite lors de la mise à jour de la formation.</div>'; break;
        case 4:
          echo '<div class="alert alert-danger my-3" role="alert">Ajout impossible d\'un utilisateur, les valeurs rentrées ne sont pas valides.</div>'; break;
        case 5:
          echo '<div class="alert alert-danger my-3" role="alert">Une erreur s\'est produite lors de la suppression de l\'utilisateur.</div>'; break; 
        case 6:
          echo '<div class="alert alert-danger my-3" role="alert">Une erreur s\'est produite lors de l\'ajout d\'un utilisateur à une formation.</div>'; break;
        case 7:
          echo '<div class="alert alert-danger my-3" role="alert">Modification de l\utilisateur avec succès</div>'; break;
        case 8:
          echo '<div class="alert alert-danger my-3" role="alert">Une erreur s\'est produite lors de la suppression de la formation.</div>'; break;
        case 26:
            echo '<div class="alert alert-danger my-3" role="alert">L\'utilisateur n\'existe pas</div>'; break;
  
    }

    switch ($success) {
      case 1 :
        echo '<div class="alert alert-success my-3" role="alert">La formation a bien été modifié.</div>'; break;
      case 2 :
        echo '<div class="alert alert-success my-3" role="alert">Suppression de l\'utilisateur enregistrée.</div>'; break;
      case 3 :
        echo '<div class="alert alert-success my-3" role="alert">Ajout de l\'utilisateur enregistré.</div>'; break;
      

    }
    ?>


    <h2 class="text-center fw-bold"><?= htmlentities($training->wording)?></h2>
    <div class="d-flex align-items-center justify-content-end">
      <form action="<?= $_SERVER["REQUEST_URI"] ?>" method="POST">
        <input type="hidden" name="action" value="disconnect">
        <button type="submit" class="btn btn-danger">
          <i class="bi bi-power me-2"></i>Se déconnecter  
        </button>
      </form> 
      <div class="ms-3"><i class="bi bi-person-circle p-0" style="font-size: 3rem"></i></div>
    </div>

    <!-- Affichage de l'image de la formation A CHANGER -->
    <div class="row">
      <div class="col-6">
        <img src="assets/images/formation/ampoules.jpg" class="w-100 border" alt="Image formation">
      </div>
      <div class="col-6 d-flex flex-column justify-content-evenly">
        <div>
          <span class="mb-2">Niveau de qualification</span>
          <div class="border rounded"><?= htmlentities($training->qualifLevel)?></div>
        </div>
        <div class="d-flex flex-column justify-content-evenly">
          <button class="btn btn-primary"><i class="bi bi-pencil-square me-2"></i>Modification de la formation</button>
          <button class="btn btn-primary"><i class="bi bi-trash me-2"></i>Suppression de la formation</button>
        </div>
      </div>
      <div class="col-12">
        <span>Description de la formation</span>  
        <div class="border rounded"><?= htmlentities($training->description)?></div>
      </div>
    </div>

    <div class="row mt-2">
      <div class="col-12 col-lg-6 m-auto fw-bold fs-4 mb-3"> 
        Liste des Educateurs de la formation
      </div>  

      <div class="col-6 col-lg-3 mb-3 text-lg-end">
        <!--Création d'un nouvel utlisateur -->
        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newUser"> 
          <i class="bi bi-person-plus-fill me-2"></i> Ajouter un utilisateur 
        </button>
      </div>
      <div class="col-6 col-lg-3 text-end mb-3">
        <!--Création d'un nouvel utlisateur -->
        <form action="<?= $_SERVER["REQUEST_URI"] ?>" method="POST">
          <input type="hidden" name="action" value="deleteTraining">
          <input type="hidden" name="idTraining" value="<?= htmlentities($training->idTraining) ?>">
          <button type="submit" class="btn btn-primary btn-removed">
            <i class="bi bi-trash-fill me-2"></i>Supprimer une formation
          </button>
        </form>      
        
      </div>
             
    </div>
    <!-- Liste des educateur de la formation -->
    <div class="row g-5">
      <!-- Tableau pour parcourir la liste des éducateur de la formation-->
      <?php
      if(is_array($admins)){
        foreach($admins as $admin){?>
          <div class="col-6 col-lg-4">
            <div class="card mt-3 d-flex flex-column align-items-center" >
              <img src="<?= htmlentities($admin->picture)?>" class="img-thumbnail w-50 mt-3" alt="Image Educateur">
              <div class="card-body">
                <p class="card-title text-center fs-4 fw-bold"><?= htmlentities($admin->lastName)?></p>
                <p class="card-text text-center fs-4 fw-bold"><?= htmlentities($admin->firstName)?></p>
              </div>
              <div class="card-body d-flex justify-content-evenly w-100">
                <button type="button" class=" btn btn-primary" data-bs-toggle="modal" data-bs-target="#ConsEducator">
                  <i class="bi bi-eye" style="font-size: 1.5rem"></i>
                </button>
                <form action="<?= $_SERVER["REQUEST_URI"] ?>" method="POST">
                  <input type="hidden" name="action" value="deleteUser">
                  <input type="hidden" name="idUser" value="<?= htmlentities($admin->idUser) ?>">
                  <input type="hidden" name="idTraining" value="<?= htmlentities($admin->idTraining) ?>">

                  <button class=" btn btn-primary btn-removed">
                    <i class="bi bi-trash-fill" style="font-size: 1.5rem"></i>
                  </button>
                </form>
              </div>
            </div>
          </div>
        <?php 
        }
      }
      ?>
    </div>
    <!-- Liste des étudiants de la formation -->
    <div class="row mt-2">
      <div class="col-12 m-auto fw-bold mt-5 fs-4"> 
        Liste des Etudiants de la formation
      </div>         
    </div>

    <div class="row g-5 ">
      <!-- Tableau pour parcourir la liste des étudiants de la formation-->
      <?php
      if(is_array($students)){
        foreach($students as $student){?>
          <div class="col-6 col-lg-4">
            <div class="card mt-3 d-flex flex-column align-items-center" >
              <img src="<?= htmlentities($student->picture)?>" class="img-thumbnail w-50 mt-3" alt="Image Eleve">
              <div class="card-body">
                <p class="card-title text-center fs-4 fw-bold"><?= htmlentities($student->lastName)?></p>
                <p class="card-title text-center fs-4 fw-bold"><?= htmlentities($student->firstName)?></p>
              </div>
            
              <div class="card-body d-flex justify-content-evenly w-100">
                <a href=" <?='/etudiants' . '/' .  htmlentities($student->firstName) . '-' . htmlentities($student->lastName) . '-' . htmlentities($student->idUser)?>">
                  <button class=" btn btn-primary">
                    <i class="bi bi-eye" style="font-size: 1.5rem"></i>
                  </button>
                </a>
                <form action="<?= $_SERVER["REQUEST_URI"] ?>" method="POST">
                  <input type="hidden" name="action" value="deleteUser">
                  <input type="hidden" name="idUser" value="<?= htmlentities($student->idUser) ?>">
                  <input type="hidden" name="idTraining" value="<?= htmlentities($student->idTraining) ?>">
                  <button class=" btn btn-primary btn-removed">
                    <i class="bi bi-trash-fill" style="font-size: 1.5rem"></i>
                  </button>
                </form>
              </div>
           </div>
          </div>
        <?php 
        }
      }
      ?>
    </div> 







  <!-- Modal -->
    <!-- Modal edit formation -->
    <div class="modal fade" id="editformation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editformationLabel" aria-hidden="true">
      <div class="modal-dialog">
        <form action="<?= $_SERVER ["REQUEST_URI"]?>" method="POST">
          <input type="hidden" name="action" value="updateTraining">
          <input type="hidden" name="idTraining" value="<?=htmlentities($training->idTraining)?>">

          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="editTrainingLabel">Modification formation</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
              <div class="row">
                <div class="col-6 text-center">
                  <label for="imgTraining"><img src="/assets/images/formation/ampoules.jpg" class="w-50 text-center" alt="Image de l'utilisateur"></label>
                  <input id="imgTraining" type="text" class="d-none" name="picture" value="azerty">
                </div>
                <div class=" col-6 m-auto">
                  <label for="Trainingwording" class="fw-bold fs-5"> Formation</label>
                  <input class="form-control" id="Trainingwording" name="wording" value="<?= htmlentities($training->wording)?>"> 

                </div>

                <div class="row">
                  <div class="col-12 mt-2">
                    <label for="trainingdescription" class="form-label pe-none">Description de la formation</label>
                    <input class="form-control" id="trainingdescription" name="description" value="<?= htmlentities($training->description)?>"> 
                  </div>
                  <div class="col-12 mt-2 mb-4">
                    <label for="qualifLevelTraining" class="form-label pe-none">Niveau de qualification</label>
                    <input class="form-control" id="qualifLevelTraining"  name="qualifLevel" value="<?= htmlentities($training->qualifLevel)?>"> 
                  </div> 
                </div>

                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                  <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Valider</button>
                </div>
                
              </div>
            </div>  
          </div>
        </form>
      </div>
    </div>

    <!-- Modal ajout utilisateur-->
    <div class="modal fade" id="newUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="newUserLabel" aria-hidden="true">
        <div class="modal-dialog">
            <form action="<?= $_SERVER ["REQUEST_URI"]?>" method="POST">
                <input type="hidden" name="action" value="addUser">
                <input type="hidden" name="idTraining" value="<?= htmlentities($training->idTraining)?>">
                    
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="newUserLabel">Ajouter utilisateur</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>

                    <div class="modal-body">
                        <div class="row">
                            <!-- Affichage de l'image lié a la formation-->
                            <div class="col-4 text-center">
                                <!--Rajouter et changer les images -->
                                <label for="imgUser"><img src="/assets/images/formation/ampoules.jpg" class="w-50 text-center" alt="Image de l'utilisateur"></label>
                                <input id="imgUser" type="text" class="d-none" name="picture" value="azerty">
                            </div>

                            <!-- Seletection du nom et du prenom-->
                            <div class="col-8">
                                <div class="input-group col-12 mt-3">
                                    <span class="input-group-text " id="inputLastName">Nom</span>
                                    <input type="text" class="form-control" aria-describedby="inputLastName" name="lastName">
                                </div>

                                <div class="input-group col-12 mt-3">
                                    <span class="input-group-text " id="inputFirstName">Prenom</span>
                                    <input type="text" class="form-control" aria-describedby="inputFirstName" name="firstName">
                                </div>
                            </div>
                            <!-- Selection de la confirmation de Mot de passe -->
                            <div class="col-12">
                                <div class="row mt-3"> 
                                    <div class="input-group">
                                        <label class="input-group-text" for="inputGroupSelectMDP">Type mot de passe</label>
                                        <select class="form-select" id="inputGroupSelectMDP" name="typePwd">
                                            <option value="1">Texte</option>
                                            <option value="2">Code</option>

                                            <!-- Mot de passe schéma on verra plus tard #imgTraining
                                            <option value="3">Schéma</option>
                                            -->
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <!--Selection du mot de passe -->
                            <div class="col-12">
                                <div class="row mt-3">
                                    <div class="input-group">
                                        <span class="input-group-text " id="inputPWD">Mot de passe</span>
                                        <input type="password" class="form-control" aria-describedby="inputPWD" name="pwd">
                                    </div>
                                </div>
                            </div>
                            <!-- Selection de la confirmation de mot de passe-->
                            <div class="col-12">
                                <div class="row mt-3">
                                    <div class="input-group">
                                        <span class="input-group-text " id="inputVerifPWD">Confirmation mot de passe</span>
                                        <input type="password" class="form-control" aria-describedby="inputVerifPWD" name="verifPwd" >
                                    </div>
                                </div>
                            </div>
                            <!-- Selection du type d'utilisateur -->
                            <div class="col-12">
                                <div class="row mt-3 mb-3">
                                    <div class="input-group">
                                        <label class="input-group-text" for="inputGroupSelectRole">Rôle de l'utilisateur</label>
                                        <select class="form-select" id="inputGroupSelectRole" name="role">
                                            <option value="student">Élève</option>
                                            <option value="educator">Educateur</option>
                                            <option value="educator-admin">Educateur administrateur</option>
                                            <option value="CIP">CIP </option>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            <div class="modal-footer text-center">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                                <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Valider</button>
                            </div>
                        </div>  
                    </div>  
                </div>
            </form>
        </div>
    </div>

    <!-- Modal Consultation éducateur-->
    <div class="modal fade" id="ConsEducator" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="ConsEducatorLabel" aria-hidden="true">
      <div class="modal-dialog">
        <form action="<?= $_SERVER ["REQUEST_URI"]?>" method="POST">
          <input type="hidden" name="action" value="updateAdmin">

          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title" id="ConsEducatorLabel">Consulation formation</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>

            <div class="modal-body">
              <div class="row">
                <div class="col-5 mt-3 text-center">
                  <img src="" id ="imgEduc" class="img-thumbnail border border-3 border-black" alt="Photo de l\éducateur">
                </div>
                <div class="col-7 mt-3 align-items">
                  <div class="col-12 my-3">
                    <label for="adminName" class="form-label pe-none fw-bold fs-5">Nom</label>
                    <input type="text" class="form-control" id="adminName" value="<?= htmlentities($admin->lastName) ?>" name="lastName">  
                  </div>
                  <div class="col-12 my-3">
                    <label for="adminFirstName" class="form-label pe-none fw-bold fs-5">Prenom</label>
                    <input type="text" class="form-control" id="adminFirstName" value="<?= htmlentities($admin->firstName) ?>" name="firstName">
                  </div>
                </div>
                <div class="col-12"> 
                  <div class="col-12 my-3 fw-bold fs-5">
                    <label class="form-label pe-none" for="SelectRole">Role de l'utilisateur</label>
                    <select class="form-select" id="SelectRole" name="role">
                      <option value="student ">Élève</option>
                      <option value="educator">Educateur</option>
                      <option value="educator-admin">Educateur éditeur</option>
                      <option value="CIP">CIP </option>
                    </select> 
                  </div>   
                  <div class="col-12 my-3 fw-bold fs-5">
                    <label class="form-label pe-none" for="SelectPWD">Type de Mot de passe</label>
                    <select class="form-select" id="SelectPWD" name="typePWD">
                      <option value="1">Code</option>
                      <option value="2">Texte</option>
                      <!-- Mot de passe schéma on verra plus tard #imgTraining
                      <option value="3">Schéma</option>
                      --> 
                    </select> 
                  </div>
                </div> 
                <div class="col-12">
                  <button type="button" class="btn btn-primary mt-3" onclick="Enabledisablefield()">
                    Modifier les informations
                  </button>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Fermer</button>
                  <button type="submit" class="btn btn-primary" data-bs-dismiss="modal">Valider</button>
                </div>
              </div>
            </form>
          </div>  
        </div>
      </div>
    </div>

</div>


<script>
    document.querySelectorAll(".btn-removed").forEach(btn => {
        btn.addEventListener("click", e => {
        if(!confirm("Voulez vous vraiment supprimer cet utilisateur ?"))
            e.preventDefault();
        });
    });
</script>


<?php
$content = ob_get_clean(); //On récupère le contenu bufferisé

require("../app/views/layout.php"); //On require le fichier avec toutes les variables définies
//pas obligatoire de définir toutes les variables, voir fichier layout.php