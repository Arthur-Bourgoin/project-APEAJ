<?php
$bsIcons = true; //Si on veut utiliser les icones de bootstrap j'inclue le fichier nécessaire

$title = "Accueil"; //Définir le titre de la page

ob_start(); //On bufferise l'affichage
?>

<div class="container mt-5">
    <div class="row">
        
        <div class="col-10 col-xl-11 m-auto"><button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newFormation"> Ajouter une formation </button></div>
        <div class="col-2 col-xl-1"><a href=""><i class="bi bi-person-circle text-black" style="font-size: 3rem"></i></a></div>   
    </div>
    
    
    <div class ="d-none d-md-block">
        <div class ="row mb-3 align-items-center">
            <?php
            foreach($formations as $formation){?>

                <div class="col-6">
                    <div class="card mt-3">
                        <div class="text-center">
                            <img src="<?= $formation['image']?>" class="card-img-top w-50" alt="...">
                        </div>
                        <div class="card-body">
                            <p class="card-title fs-4 fw-bold"><?= $formation['Libelle']?></p>
               
                            <p class="card-text"><?= $formation['Description']?></p>
                            <div class="d-flex justify-content-around "> 
                                <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#newUser"> 
                                    <i class="bi bi-person-plus-fill" style="font-size: 2rem"></i>
                                </button>
                                <a href=" <?='/formation-' . $formation['Id_formation'] . '/supprimer'?>" >
                                    <button class="btn btn-primary btn-removed">
                                        <i class="bi bi-trash-fill" style="font-size: 2rem"></i>
                                    </button>
                                </a>                
                                <a href="/formation-<?=$formation['Id_formation']?>">
                                    <button type="button" class="btn btn-primary">
                                        <i class="bi bi-eye" style="font-size: 2rem"></i>
                                    </button>
                                </a>
                                    
                                
                                
                            </div>    
                        </div>
                    </div>
                </div>
            <?php   
            }
            ?>
        </div>
    </div>

    <div class="d-block d-md-none">
        
            <?php
            foreach ($formations as $formation) {?>
                <div class="row border mb-3">
                    <div class="col-4">
                        <div class="text-center">
                            <img src="<?= $formation['image']?>" class="w-100">
                        </div>
                    </div>
                    <div class="col-8">
                        <p class=" fs-3 fw-bold text-center"><?= $formation['Libelle']?></p>
                        <div class="d-flex">
                            <div class="mb-3 m-auto">    
                                <button type="button" class=" btn btn-primary" data-bs-toggle="modal" data-bs-target="#newUser">
                                    <i class="bi bi-person-plus-fill"></i>
                                </button>
                            </div>
                            <div class="mb-3 m-auto">
                                <a href=" <?='/formation-' . $formation['Id_formation'] . '/supprimer'?>">
                                    <button class=" btn btn-primary btn-removed">
                                        <i class="bi bi-trash-fill"></i>
                                    </button>
                                </a>
                            </div>
                            <div class="mb-3 m-auto">
                                <a href="/formation-<?=$formation['Id_formation']?>">
                                    <button class=" btn btn-primary">
                                        <i class="bi bi-eye"></i>
                                    </button>
                                </a>
                            </div>
                        </div>
                    </div>
                </div>
            <?php
            }
            ?>           
        
    </div>

    <!-- Modal -->
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
                                    <div class="input-group">
                                        <span class="input-group-text " id="basic-addon1">Login</span>
                                        <input type="text" class="form-control" aria-label="Login" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>

                            <!-- Selection de la confirmation de Mot de passe -->
                            <div class="col-12">
                                <div class="row mt-3"> 
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
                                    <div class="input-group">
                                        <span class="input-group-text " id="basic-addon4">Mot de passe</span>
                                        <input type="password" class="form-control" aria-label="MDP" aria-describedby="basic-addon4">
                                    </div>
                                </div>
                            </div>
                            <!-- Selection de la confirmation de mot de passe-->
                            <div class="col-12">
                                <div class="row mt-3">
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


    <div class="modal fade" id="newFormation" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="newFormationLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="newFormationLabel">Ajouter utilisateur</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>

                <div class="modal-body">
       
                    <form action="<?= $_SERVER ["REQUEST_URI"]?>" method="POST">
                        <div class="row">

                            <!--Selection de l'image -->
                            <div class="col-12">
                                <div class="row mt-3">
                                     
                                    <input type="file" class="form-control-file" id="ImageFormation">
                                </div>
                            </div>

                            
                           
                            <!--Selection du Nom de la formation -->
                            <div class="col-12">
                                <div class="row mt-3">
                                    <div class="input-group">
                                        <span class="input-group-text " id="basic-addon1">Nom de la formation</span>
                                        <input type="text" class="form-control" aria-label="NameFormation" aria-describedby="basic-addon1">
                                    </div>
                                </div>
                            </div>

                            

                            <!--Selection du niveau de la formation -->
                            <div class="col-12">
                                <div class="row mt-3 ">
                                    <div class="input-group">
                                        <span class="input-group-text " id="basic-addon3">Niveau de la formation</span>
                                        <input type="text" class="form-control" aria-label="LevelFormation" aria-describedby="basic-addon3">
                                    </div>
                                </div>
                            </div>
                            <!--Selection de la description de la formation -->
                            <div class="col-12">
                                <div class="row mt-3 mb-3">
                                    <div class="form-group">
                                        <label for="FormDescription"> Description Formation</label>                                        
                                        <textarea class="form-control" id="FormDescription" rows="3"></textarea> 
                                    </div>
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
        if(!confirm("Voulez vous vraiment supprimer cet formation ?"))
            e.preventDefault();
        });
    });
</script>

<?php
$content = ob_get_clean(); //On récupère le contenu bufferisé

require("../app/views/layout.php"); //On require le fichier avec toutes les variables définies
//pas obligatoire de définir toutes les variables, voir fichier layout.php