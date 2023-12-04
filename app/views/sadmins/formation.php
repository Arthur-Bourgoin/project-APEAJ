<?php
$bsIcons = true; //Si on veut utiliser les icones de bootstrap j'inclue le fichier nécessaire

$title = "Consultation Formation"; //Définir le titre de la page

ob_start(); //On bufferise l'affichage
?>
<div class="container mt-5">
  <form action="" method="">
    <div class="row">
      <div class="col-10 col-xl-11 m-auto fw-bold fs-2">Formation <?= $formation['Libelle']?></div>  
      <div class="col-2 col-xl-1"><a href=""><i class="bi bi-person-circle text-black" style="font-size: 3rem"></i></a></div>
    </div>        
    <!-- Affichage de l'image de la formation -->
    <div class="row">
      <div class="col-4 text-center">
        <img src="<?= $formation['image']?>" class="card-img-top w-75" alt="Image formation">
      </div>

      <!-- Affichage de des information de la formation -->



      <div class="col-8">  
        <div class="col-12 mt-2">
          <div class="">Description de la formation
            <div class="border rounded px-3 py-2">
              <?= $formation['Description']?>
            </div>
          </div>
        </div>
      
        <div class="mt-2 col-12">

          <div class="">Niveau de qualification
            <div class="border rounded px-3 py-2">
              <?= $formation['NiveauQual']?>
            </div>
          </div>
        </div>
      </div> 





    </div> 
  </form>
  <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#editformation">
      Modifier la formation
  </button>


  <div class="row mt-2">
    <div class="col-10 m-auto fw-bold fs-4"> 
      Liste des Educateurs de la formation
    </div>  
    <div class="col-2">
      <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newUser"> 
        Ajouter un utilisateur 
      </button>
    </div>       
  </div>
  <!-- Liste des educateur de la formation -->
  <div class="row g-5">
    <!-- Tableau pour parcourir la liste des éducateur de la formation-->
    <?php
      foreach($educators as $educator)
      {?>
      <div class="col-6 col-lg-4">
        <!-- -->
        <div class="card mt-3" >
          <img src="<?= $educator['image']?>" class="img-top" alt="Image élève">
          <div class="card-body">
            <p class="card-title text-center fs-4 fw-bold"><?= $educator['Nom']?> <?= $educator['Prenom']?></p>
          </div>
          <div class="card-body d-flex justify-content-around">
            <button type="button" class=" btn btn-primary" data-bs-toggle="modal" data-bs-target="#ConsEducator">
              <i class="bi bi-eye" style="font-size: 1.5rem"></i>
            </button>
            <a href=" <?='/' . $educator['Prenom'] . '-' . $educator['Nom'] . '-' . $educator['Id_utilisateur'] . '/supprimer'?> ">
              <button class="btn btn-primary btn-removed">
                <i class="bi bi-trash-fill" style="font-size: 1.5rem"></i>
              </button>
            </a>
          </div>
        </div>
      </div>
    <?php 
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
      foreach($students as $student)
      {?>
      <div class="col-6 col-lg-4">
        <div class="card mt-3" >
          <img src="<?= $student['image']?>" class="card-img-top" alt="Image élève">
          <div class="card-body">
            <p class="card-title text-center fs-4 fw-bold"><?= $student['Nom']?> <?= $student['Prenom']?></p>
          </div>
          
          <div class="card-body d-flex justify-content-around">
            <a href=" <?='/etudiants' . '/' .  $student['Prenom'] . '-' . $student['Nom'] . '-' . $student['Id_utilisateur']?>">
              <button class=" btn btn-primary">
                <i class="bi bi-eye" style="font-size: 1.5rem"></i>
              </button>
            </a>
            <a href=" <?='/' . $student['Prenom'] . '-' . $student['Nom'] . '-' . $student['Id_utilisateur'] . '/supprimer'?>">
              <button class=" btn btn-primary btn-removed">
                <i class="bi bi-trash-fill" style="font-size: 1.5rem"></i>
              </button>
            </a>
          </div>
        </div>
      </div>
    <?php 
    }
    ?>
  </div> 







  <!-- Modal -->
    <!-- Modal edit formation -->
    <div class="modal fade" id="editformation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="editformationLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="editformationLabel">Modification formation</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <div class="modal-body">
            <form action="<?= $_SERVER ["REQUEST_URI"]?>" method="POST">
              <div class="row">
                <div class="col-6 text-center">
                  <img src="<?= $formation['image']?>" class="img-top w-50" alt="Image formation">
                </div>
                <div class=" col-6 m-auto fw-bold fs-5">
                  Formation <?= $formation['Libelle']?>
                </div>
                <div class="row">
                  <div class="col-12 mt-2">
                    <label for="FormDescriptionformation" class="form-label pe-none">Description de la formation</label>
                    <input class="form-control" id="FormDescriptionformation" value="<?= $formation['Description']?>"> 
                  </div>
                  <div class="col-12 mt-2 mb-4">
                    <label for="FormNiveauQual" class="form-label pe-none">Niveau de qualification</label>
                    <input class="form-control" id="FormNiveauQual" value="<?= $formation['NiveauQual']?>"> 
                  </div> 
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

    <!-- Modal Création Utilisateur-->
    <div class="modal fade" id="newUser" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="newUserLabel" aria-hidden="true">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="newUserLabel">Ajouter utilisateur</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>

          <div class="modal-body">
       
            <form action="<?= $_SERVER ["REQUEST_URI"]?>" method="POST">
              <div class="row">
                <!-- Affichage de l'image lié a la formation-->
                <div class="col-4 text-center">
                  <img src="<?= $formation['image']?>" class="card-img-top w-75" alt="Image formation">
                </div>
                <!-- Seletection du nom et du prenom-->
                <div class="col-8">

                  <!--
                  <div class="form-floating col-12 mt-3">
                   <input type="text" class="form-control" id="floatingNom" placeholder="">
                   <label for="floatingNom">Nom</label>
                  </div>
                   
                  <div class="form-floating col-12 mt-3"> 
                    <input type="text" class="form-control" id="floatingPrenom" placeholder="">
                    <label for="floatingPrenom">Prenom</label> 
                  </div>
                  -->
                  <div class="input-group col-12 mt-3">
                    <span class="input-group-text " id="basic-addon3">Nom :</span>
                    <input type="text" class="form-control" aria-label="Nom" aria-describedby="basic-addon3">
                  </div>

                  <div class="input-group col-12 mt-3">
                    <span class="input-group-text " id="basic-addon2">Prenom :</span>
                    <input type="text" class="form-control" aria-label="Prenom" aria-describedby="basic-addon2">
                  </div>

                </div>

                <!--Selection du login -->
                <div class="col-12">
                  <div class="row mt-3">
                    <!--
                      <div class="col-4 d-flex">
                        <label for="idlogin" class="my-auto">Login : </label>
                      </div>
                      <div class="col-8">
                        <input class="form-control" id="idlogin">
                      </div>
                    -->
                    <div class="input-group">
                      <span class="input-group-text " id="basic-addon1">Login</span>
                         
                          <input type="text" class="form-control" aria-label="Login" aria-describedby="basic-addon1">
                      
                    </div>

                  </div>
                </div>

                <!-- Selection de la confirmation de Mot de passe -->
                <div class="col-12">
                  <div class="row mt-3">
                    <!--
                    <div class="col-4 d-flex">
                      <label for="idTypeMDP" class="my-auto">Type de mdp : </label>
                    </div>
                    <div class="col-8">
                      <select class="form-select">
                        <option value="1" id="idTypeMDP">Mot de passe</option>
                        <option value="2" id="idTypeMDP">Code</option>
                        <option value="3" id="idTypeMDP">Schéma</option>
                      </select>
                    </div> 
                    -->
                    <div class="input-group">
                      <label class="input-group-text" for="inputGroupSelectMDP">Type mot de passe</label>
                      <select class="form-select" id="inputGroupSelectMDP">
                        <option value="1">Texte</option>
                        <option value="2">Code</option>
                        <option value="3">Schéma</option>
                      </select>
                    </div>




                  </div>
                </div>
                <!--Selection du mot de passe -->
                <div class="col-12">
                  <div class="row mt-3">
                  <!--
                    <div class="col-4 d-flex">
                      <label for="idMDP" class="my-auto">Mot de passe :</label>
                    </div>
                    <div class="col-8">
                      <input class="form-control" id="idMDP">
                    </div>
                  -->
                    <div class="input-group">
                      <span class="input-group-text " id="basic-addon4">Mot de passe</span>
                      <input type="password" class="form-control" aria-label="MDP" aria-describedby="basic-addon4">
                    </div>


                  </div>
                </div>
                <!-- Selection de la confirmation de mot de passe-->
                <div class="col-12">
                  <div class="row mt-3">
                    <!--
                    <div class="col-4 d-flex">
                      <label for="idConfMDP" class="my-auto">Confirmation mot de passe :</label>
                    </div>
                    <div class="col-8">
                      <input class="form-control" id="idConfMDP">
                    </div>
                    -->


                    <div class="input-group">
                      <span class="input-group-text " id="basic-addon5">Confirmation mot de passe</span>
                      <input type="password" class="form-control" aria-label="ConfMDP" aria-describedby="basic-addon5">
                    </div>


                  </div>
                </div>
                <!-- Selection du type d'utilisateur -->
                <div class="col-12">
                  <div class="row mt-3 mb-3">

                  <div class="input-group">
                      <label class="input-group-text" for="inputGroupSelectRole">Role de l'utilisateur</label>
                      <select class="form-select" id="inputGroupSelectRole">
                        <option value="1">Élève</option>
                        <option value="2">Educateur</option>
                        <option value="3">Educateur éditeur</option>
                        <option value="4">CIP </option>
                      </select>
                    </div>






                <!--
                    <div class="col-4">
                      <label>Type utilisateur :</label>
                    </div>
                    <div class="col-8 mb-2">
                    
                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioUtilisateur" id="Éducateur"> 
                        <label class="form-check-label" for="Éducateur">
                          Éducateur
                        </label>
                      </div>

                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioUtilisateur" id="ÉducateurÉditeur"> 
                        <label class="form-check-label" for="ÉducateurÉditeur">
                          Éducateur éditeur
                        </label>
                      </div>

                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioUtilisateur" id="CIP"> 
                        <label class="form-check-label" for="CIP">
                          CIP
                        </label>
                      </div>
                       

                      <div class="form-check">
                        <input class="form-check-input" type="radio" name="flexRadioUtilisateur" id="Élève">
                        <label class="form-check-label" for="Élève">
                          Élève
                        </label>
                      </div>
                  </div>
                    -->
                  </div>
                </div>
      
                <div class="modal-footer text-center">
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