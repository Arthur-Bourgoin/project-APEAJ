<?php
$bsIcons = true;
$scripts = "<script src='/assets/js/app.js' type='module'>
</script><script src='/assets/js/CurrentUser.js' type='module'></script>";
$title = "Création fiche";

ob_start();
?>

<style>
    .div-img {
        height: 100px;
    }
</style>
<div class="container">
    <div class="row m-0">
        <div class="col-md-3 col-lg-2 border d-flex flex-row flex-md-column">
            <div class="border px-2 m-1">
                <div class="form-switch d-flex flex-column align-items-center p-0 my-1">
                    <label class="form-label mb-0 text-center" for="textToSpeech">Text to speech</label>
                    <input class="form-check-input my-3 mx-0" type="checkbox" role="switch" id="textToSpeech">
                </div>
            </div>
            <div class="border px-2 m-1">
                <div class="d-flex flex-column align-items-center">
                    <label class="form-label mb-0" for="bgColor">Couleur fond</label>
                    <input class="form-control form-control-color m-3" type="color" id="bgColor">
                </div>
            </div>
            <div class="border m-1">
                choix 1
            </div>
            <div class="border m-1">
                choix 2
            </div>
            <div class="border m-1">
                choix 3
            </div>
            <div class="border m-1">
                choix 4
            </div>
        </div>
        <div id="divForm" class="col-md-9 col-lg-10 border p-3">
        <form action="" method="POST">
            <fieldset class="border p-2 pb-3 mb-4 form-group">
                <h1 class="text-center m-0">FICHE D'INTERVENTION N°03</h1>
            </fieldset>
            <fieldset class="border p-2 pb-3 my-4 form-group">
                <legend class="float-none w-auto px-2">Intervenant</legend>
                <div class="container">
                    <div class="row">
                        <!--
                        <div id="div-studentLastName" class="col-6 py-2 position-relative">
                            <div class="div-label">
                                <label for="nomIntervenant" class="form-label mb-0 pe-none d-flex align-items-center">Nom de l'intervenant</label>
                            </div>
                            <div class="div-input">
                                <input id="nomIntervenant" class="form-control pe-none" type="text">
                            </div>
                        </div>
                        <img class="mb-1 me-1 border border-black rounded border-2" src="/assets/images/cable_elec.jfif" width="50%" alt="">
                        
                        <div id="div-studentLastName" class="col-6 py-2 position-relative">
                            <div class="div-img d-flex justify-content-center mb-2">
                                <img class="border border-black rounded border-2" src="/assets/images/cable_elec.jfif" width="80px" alt="">
                            </div>
                            <div class="div-label">
                                <label for="nomIntervenant" class="form-label mb-0 pe-none d-flex align-items-center">Nom de l'intervenant</label>
                            </div>
                            <div class="div-input input-group">
                                <input id="nomIntervenant" class="form-control pe-none" type="text">
                            </div>
                        </div>
                        -->
                        <div id="div-studentLastName" class="col-6 d-flex flex-column justify-content-end position-relative p-2">
                            <div class="div-img d-flex justify-content-center mb-1 d-none">
                                <img class="border border-black rounded border-2 h-auto w-auto object-fit-contain">
                            </div>
                            <label for="nomIntervenant" class="form-label mb-0 pe-none d-none">Nom de l'intervenant</label>
                            <div class="div-input input-group">
                                <input id="nomIntervenant" class="form-control pe-none" type="text">
                            </div>
                        </div>
                        <!--
                        <div id="div-studentFirstName" class="col-6 py-2 d-flex flex-column justify-content-end">
                            <div class="div-label">
                                <label for="prenomIntervenant" class="form-label mb-0 pe-none">Prénom de l'intervenant</label>
                            </div>
                            <div class="div-input">
                                <input id="prenomIntervenant" class="form-control pe-none" type="text">
                            </div>
                        </div>
                        style="height: 100px;"
                        -->
                        <div id="div-studentFirstName" class="col-6 d-flex flex-column justify-content-end position-relative p-2">
                            <div class="div-img d-flex justify-content-center mb-1 d-none">
                                <img class="border border-black rounded border-2 h-auto w-auto object-fit-contain">
                            </div>
                            <label for="prenomIntervenant" class="form-label mb-0 pe-none d-none">Prénom de l'intervenant</label>
                            <div class="div-input input-group">
                                <input id="prenomIntervenant" class="form-control pe-none" type="text">
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset class="border p-2 pb-3 my-4 form-group">
                <legend class="float-none w-auto px-2">Demande</legend>
                <div class="container">
                    <div class="row gy-4">
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6 div-label d-flex align-items-center">
                                    <label for="nomDemandeur" class="form-label mb-0 me-1">Nom du demandeur</label>
                                    <i class="bi bi-volume-up"></i>
                                </div>
                                <div class="col-6 div-input">
                                    <input id="nomDemandeur" class="form-control" type="text">
                                </div>
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="div-label">
                                <label for="dateDemande" class="form-label mb-0">Date de la demande</label>
                                <i class="bi bi-volume-up"></i>
                            </div>
                            <div class="div-input">
                                <input id="dateDemande" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="col-6">
                            <div class="div-label">
                                <label for="localisation" class="form-label mb-0">Localisation</label>
                                <i class="bi bi-volume-up"></i>
                            </div>
                            <div class="div-input">
                                <input id="localisation" class="form-control" type="text">
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="div-label">
                                <label for="descriptionDemande" class="col-12 form-label mb-0">Description de la demande</label>
                            </div>
                            <div class="div-input">
                                <textarea id="descriptionDemande" class="form-control" rows="5"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="row">
                                <div class="col-6 d-flex align-items-center">
                                    <label for="degreUrgence" class="form-label mb-0 me-1">Degré d'urgence</label>
                                    <i class="bi bi-volume-up"></i>
                                </div>
                                <div class="col-6">
                                    <input id="degreUrgence" class="form-control" type="text">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset class="border p-2 pb-3 my-4 form-group">
                <legend class="float-none w-auto px-2">Intervention</legend>
                <div class="container">
                    <div class="row gy-4">
                        <div class="col-12">
                            <label for="dateIntervention" class="form-label mb-0">Date d'intervention</label>
                            <input id="dateIntervention" class="form-control" type="date">
                        </div>
                        <div class="col-8">
                            <label for="selectDuree" class="form-label mb-0">Durée de l'opération</label>
                            <select id="selectDuree" class="form-select">
                                <option>-- Choisir une durée --</option>
                                <option>00h15</option>
                                <option>00h30</option>
                                <option>00h45</option>
                                <option>01h00</option>
                                <option>01h15</option>
                                <option>01h30</option>
                                <option>01h45</option>
                                <option>02h00</option>
                                <option>02h15</option>
                                <option>02h30</option>
                                <option>02h45</option>
                                <option>03h00</option>
                                <option>03h15</option>
                                <option>03h30</option>
                                <option>03h45</option>
                                <option>04h00</option>
                            </select>   
                        </div> 
                        <div class="col-4 ">
                            <label for="anonymeCheck" class="form-label mb-0">--Du texte--</label>
                            <div>
                                <input id="anonymeCheck" class="form-check-input" type="checkbox">
                            </div>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset class="border p-2 pb-3 my-4 form-group">
                <legend class="float-none w-auto px-2">Type de maintenance</legend>
                <div class="container">
                    <div class="row gy-2">
                        <div class="col-12">
                            <input id="ameliorative" class="form-check-input" type="checkbox">
                            <label for="ameliorative" class="form-check-label">Améliorative</label>
                        </div>
                        <div class="col-12">
                            <input id="preventive" class="form-check-input" type="checkbox">
                            <label for="preventive" class="form-check-label">Préventive</label>
                        </div>
                        <div class="col-12">
                            <input id="corrective" class="form-check-input" type="checkbox">
                            <label for="corrective" class="form-check-label">Corrective</label>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset class="border p-2 pb-3 my-4 form-group">
                <legend class="float-none w-auto px-2">Nature de l'intervention</legend>
                <div class="container">
                    <div class="row gy-2">
                        <div class="col-12">
                            <input id="amenagement" class="form-check-input" type="checkbox">
                            <label for="amenagement" class="form-check-label">Aménagement</label>
                        </div>
                        <div class="col-12">
                            <input id="finitions" class="form-check-input" type="checkbox">
                            <label for="finitions" class="form-check-label">Finitions</label>
                        </div>
                        <div class="col-12">
                            <input id="sanitaire" class="form-check-input" type="checkbox">
                            <label for="sanitaire" class="form-check-label">Installation sanitaire</label>
                        </div>
                        <div class="col-12">
                            <input id="electrique" class="form-check-input" type="checkbox">
                            <label for="electrique" class="form-check-label">Installation électrique</label>
                        </div>
                    </div>
                </div>
            </fieldset>
            <fieldset class="border p-2 pb-3 my-4 form-group">
                <legend class="float-none w-auto px-2">Travaux</legend>
                <div class="container">
                    <div class="row gy-4">
                        <div class="col-12">
                            <label for="travauxRealises" class="form-label mb-0">Travaux réalisés</label>
                            <textarea id="travauxRealises" class="form-control" rows="5"></textarea>
                        </div>
                        <div class="col-12">
                            <label for="travauxNonRealises" class="form-label mb-0">Travaux non réalisés</label>
                            <textarea id="travauxNonRealises" class="form-control" rows="5"></textarea>
                        </div>
                        <div class="col-12">
                            <input id="newIntervention" class="form-check-input" type="checkbox">
                            <label for="newIntervention" class="form-check-label">Nécessite une nouvelle intervention</label>
                        </div>          
                    </div>
                </div>
            </fieldset>  
            <fieldset class="border p-2 pb-3 my-4 form-group">
                <legend class="float-none w-auto px-2">Travaux</legend>
                <div class="container">
                    <div class="row gy-4">
                        <div class="col-6">
                            <select class="form-select form-select-sm">
                                <option>-- Choisir une valeur --</option>
                                <option>Bande à joint</option>
                                <option>Bande armée à joint</option>
                                <option>Champlat</option>
                                <option>Chevilles à expansion avec patte à vis</option>
                                <option>Chevilles à frapper</option>
                                <option>Chevilles autoforeuses - Fixation plaque de plâtre</option>
                                <option>Chiffons</option>
                                <option>Colle acrylique de fixation pour plinthe</option>
                                <option>Colle pour toile de verre</option>
                                <option>Croisillons épaisseur 2 mm</option>
                                <option>Cylindre double entrée profil européen</option>
                                <option>Enduit à joint</option>
                                <option>Enduit de rebouchage</option>
                                <option>Ensemble de porte - Clé I</option>
                                <option>Ensemble de porte - Clé L</option>
                                <option>Ensemble intérupteur SA/VV - encastrable</option>
                                <option>Ensemble Prise 2P+T - encastrable</option>
                                <option>Etagère bois 20 x 60</option>
                                <option>Faïence mur 20 x 20</option>
                                <option>Joint poudre carrelage</option>
                                <option>Lot de colorants universels de peintre</option>
                                <option>Montant M48</option>
                                <option>Mortier colle poudre</option>
                                <option>Panneau bois (OSB ou aggloméré)</option>
                                <option>Papier de verre grain 120</option>
                                <option>Papier de verre grain 80</option>
                                <option>Peinture acrylique satinée</option>
                                <option>Peinture boiseries acrylique brillant</option>
                                <option>Peinture impression</option>
                                <option>Planche de coffrage</option>
                                <option>Plaque de Plâtre BA13</option>
                                <option>Plinthe MDF ou bois brut</option>
                                <option>Pointes tête homme</option>
                                <option>Portemanteau mural bois 2 têtes</option>
                                <option>Rail R48</option>
                                <option>Revêtement à peindre - toile de verre (largeur 1 m)</option>
                                <option>Serrure satandard encastrable  NF Cylindre européen</option>
                                <option>Serrure standard en L encastrable </option>
                                <option>Tablette bois</option>
                                <option>Tasseau raboté</option>
                                <option>Verrou à bouton - cylindre 40 mm</option>
                                <option>Vis à bois 30 mm</option>
                                <option>Vis TRPF</option>
                                <option>Vis TTPC 25</option>
                                <option>Vis TTPC 35</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <select class="form-select form-select-sm">
                                <option>-- Choisir une valeur --</option>
                                <option>Bande à joint</option>
                                <option>Bande armée à joint</option>
                                <option>Champlat</option>
                                <option>Chevilles à expansion avec patte à vis</option>
                                <option>Chevilles à frapper</option>
                                <option>Chevilles autoforeuses - Fixation plaque de plâtre</option>
                                <option>Chiffons</option>
                                <option>Colle acrylique de fixation pour plinthe</option>
                                <option>Colle pour toile de verre</option>
                                <option>Croisillons épaisseur 2 mm</option>
                                <option>Cylindre double entrée profil européen</option>
                                <option>Enduit à joint</option>
                                <option>Enduit de rebouchage</option>
                                <option>Ensemble de porte - Clé I</option>
                                <option>Ensemble de porte - Clé L</option>
                                <option>Ensemble intérupteur SA/VV - encastrable</option>
                                <option>Ensemble Prise 2P+T - encastrable</option>
                                <option>Etagère bois 20 x 60</option>
                                <option>Faïence mur 20 x 20</option>
                                <option>Joint poudre carrelage</option>
                                <option>Lot de colorants universels de peintre</option>
                                <option>Montant M48</option>
                                <option>Mortier colle poudre</option>
                                <option>Panneau bois (OSB ou aggloméré)</option>
                                <option>Papier de verre grain 120</option>
                                <option>Papier de verre grain 80</option>
                                <option>Peinture acrylique satinée</option>
                                <option>Peinture boiseries acrylique brillant</option>
                                <option>Peinture impression</option>
                                <option>Planche de coffrage</option>
                                <option>Plaque de Plâtre BA13</option>
                                <option>Plinthe MDF ou bois brut</option>
                                <option>Pointes tête homme</option>
                                <option>Portemanteau mural bois 2 têtes</option>
                                <option>Rail R48</option>
                                <option>Revêtement à peindre - toile de verre (largeur 1 m)</option>
                                <option>Serrure satandard encastrable  NF Cylindre européen</option>
                                <option>Serrure standard en L encastrable </option>
                                <option>Tablette bois</option>
                                <option>Tasseau raboté</option>
                                <option>Verrou à bouton - cylindre 40 mm</option>
                                <option>Vis à bois 30 mm</option>
                                <option>Vis TRPF</option>
                                <option>Vis TTPC 25</option>
                                <option>Vis TTPC 35</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <select class="form-select form-select-sm">
                                <option>-- Choisir une valeur --</option>
                                <option>Bande à joint</option>
                                <option>Bande armée à joint</option>
                                <option>Champlat</option>
                                <option>Chevilles à expansion avec patte à vis</option>
                                <option>Chevilles à frapper</option>
                                <option>Chevilles autoforeuses - Fixation plaque de plâtre</option>
                                <option>Chiffons</option>
                                <option>Colle acrylique de fixation pour plinthe</option>
                                <option>Colle pour toile de verre</option>
                                <option>Croisillons épaisseur 2 mm</option>
                                <option>Cylindre double entrée profil européen</option>
                                <option>Enduit à joint</option>
                                <option>Enduit de rebouchage</option>
                                <option>Ensemble de porte - Clé I</option>
                                <option>Ensemble de porte - Clé L</option>
                                <option>Ensemble intérupteur SA/VV - encastrable</option>
                                <option>Ensemble Prise 2P+T - encastrable</option>
                                <option>Etagère bois 20 x 60</option>
                                <option>Faïence mur 20 x 20</option>
                                <option>Joint poudre carrelage</option>
                                <option>Lot de colorants universels de peintre</option>
                                <option>Montant M48</option>
                                <option>Mortier colle poudre</option>
                                <option>Panneau bois (OSB ou aggloméré)</option>
                                <option>Papier de verre grain 120</option>
                                <option>Papier de verre grain 80</option>
                                <option>Peinture acrylique satinée</option>
                                <option>Peinture boiseries acrylique brillant</option>
                                <option>Peinture impression</option>
                                <option>Planche de coffrage</option>
                                <option>Plaque de Plâtre BA13</option>
                                <option>Plinthe MDF ou bois brut</option>
                                <option>Pointes tête homme</option>
                                <option>Portemanteau mural bois 2 têtes</option>
                                <option>Rail R48</option>
                                <option>Revêtement à peindre - toile de verre (largeur 1 m)</option>
                                <option>Serrure satandard encastrable  NF Cylindre européen</option>
                                <option>Serrure standard en L encastrable </option>
                                <option>Tablette bois</option>
                                <option>Tasseau raboté</option>
                                <option>Verrou à bouton - cylindre 40 mm</option>
                                <option>Vis à bois 30 mm</option>
                                <option>Vis TRPF</option>
                                <option>Vis TTPC 25</option>
                                <option>Vis TTPC 35</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <select class="form-select form-select-sm">
                                <option>-- Choisir une valeur --</option>
                                <option>Bande à joint</option>
                                <option>Bande armée à joint</option>
                                <option>Champlat</option>
                                <option>Chevilles à expansion avec patte à vis</option>
                                <option>Chevilles à frapper</option>
                                <option>Chevilles autoforeuses - Fixation plaque de plâtre</option>
                                <option>Chiffons</option>
                                <option>Colle acrylique de fixation pour plinthe</option>
                                <option>Colle pour toile de verre</option>
                                <option>Croisillons épaisseur 2 mm</option>
                                <option>Cylindre double entrée profil européen</option>
                                <option>Enduit à joint</option>
                                <option>Enduit de rebouchage</option>
                                <option>Ensemble de porte - Clé I</option>
                                <option>Ensemble de porte - Clé L</option>
                                <option>Ensemble intérupteur SA/VV - encastrable</option>
                                <option>Ensemble Prise 2P+T - encastrable</option>
                                <option>Etagère bois 20 x 60</option>
                                <option>Faïence mur 20 x 20</option>
                                <option>Joint poudre carrelage</option>
                                <option>Lot de colorants universels de peintre</option>
                                <option>Montant M48</option>
                                <option>Mortier colle poudre</option>
                                <option>Panneau bois (OSB ou aggloméré)</option>
                                <option>Papier de verre grain 120</option>
                                <option>Papier de verre grain 80</option>
                                <option>Peinture acrylique satinée</option>
                                <option>Peinture boiseries acrylique brillant</option>
                                <option>Peinture impression</option>
                                <option>Planche de coffrage</option>
                                <option>Plaque de Plâtre BA13</option>
                                <option>Plinthe MDF ou bois brut</option>
                                <option>Pointes tête homme</option>
                                <option>Portemanteau mural bois 2 têtes</option>
                                <option>Rail R48</option>
                                <option>Revêtement à peindre - toile de verre (largeur 1 m)</option>
                                <option>Serrure satandard encastrable  NF Cylindre européen</option>
                                <option>Serrure standard en L encastrable </option>
                                <option>Tablette bois</option>
                                <option>Tasseau raboté</option>
                                <option>Verrou à bouton - cylindre 40 mm</option>
                                <option>Vis à bois 30 mm</option>
                                <option>Vis TRPF</option>
                                <option>Vis TTPC 25</option>
                                <option>Vis TTPC 35</option>
                            </select>
                        </div>
                        <div class="col-6">
                            <select class="form-select form-select-sm">
                                <option>-- Choisir une valeur --</option>
                                <option>Bande à joint</option>
                                <option>Bande armée à joint</option>
                                <option>Champlat</option>
                                <option>Chevilles à expansion avec patte à vis</option>
                                <option>Chevilles à frapper</option>
                                <option>Chevilles autoforeuses - Fixation plaque de plâtre</option>
                                <option>Chiffons</option>
                                <option>Colle acrylique de fixation pour plinthe</option>
                                <option>Colle pour toile de verre</option>
                                <option>Croisillons épaisseur 2 mm</option>
                                <option>Cylindre double entrée profil européen</option>
                                <option>Enduit à joint</option>
                                <option>Enduit de rebouchage</option>
                                <option>Ensemble de porte - Clé I</option>
                                <option>Ensemble de porte - Clé L</option>
                                <option>Ensemble intérupteur SA/VV - encastrable</option>
                                <option>Ensemble Prise 2P+T - encastrable</option>
                                <option>Etagère bois 20 x 60</option>
                                <option>Faïence mur 20 x 20</option>
                                <option>Joint poudre carrelage</option>
                                <option>Lot de colorants universels de peintre</option>
                                <option>Montant M48</option>
                                <option>Mortier colle poudre</option>
                                <option>Panneau bois (OSB ou aggloméré)</option>
                                <option>Papier de verre grain 120</option>
                                <option>Papier de verre grain 80</option>
                                <option>Peinture acrylique satinée</option>
                                <option>Peinture boiseries acrylique brillant</option>
                                <option>Peinture impression</option>
                                <option>Planche de coffrage</option>
                                <option>Plaque de Plâtre BA13</option>
                                <option>Plinthe MDF ou bois brut</option>
                                <option>Pointes tête homme</option>
                                <option>Portemanteau mural bois 2 têtes</option>
                                <option>Rail R48</option>
                                <option>Revêtement à peindre - toile de verre (largeur 1 m)</option>
                                <option>Serrure satandard encastrable  NF Cylindre européen</option>
                                <option>Serrure standard en L encastrable </option>
                                <option>Tablette bois</option>
                                <option>Tasseau raboté</option>
                                <option>Verrou à bouton - cylindre 40 mm</option>
                                <option>Vis à bois 30 mm</option>
                                <option>Vis TRPF</option>
                                <option>Vis TTPC 25</option>
                                <option>Vis TTPC 35</option>
                            </select>
                        </div>        
                        <div class="col-6">
                            <select class="form-select form-select-sm">
                                <option>-- Choisir une valeur --</option>
                                <option>Bande à joint</option>
                                <option>Bande armée à joint</option>
                                <option>Champlat</option>
                                <option>Chevilles à expansion avec patte à vis</option>
                                <option>Chevilles à frapper</option>
                                <option>Chevilles autoforeuses - Fixation plaque de plâtre</option>
                                <option>Chiffons</option>
                                <option>Colle acrylique de fixation pour plinthe</option>
                                <option>Colle pour toile de verre</option>
                                <option>Croisillons épaisseur 2 mm</option>
                                <option>Cylindre double entrée profil européen</option>
                                <option>Enduit à joint</option>
                                <option>Enduit de rebouchage</option>
                                <option>Ensemble de porte - Clé I</option>
                                <option>Ensemble de porte - Clé L</option>
                                <option>Ensemble intérupteur SA/VV - encastrable</option>
                                <option>Ensemble Prise 2P+T - encastrable</option>
                                <option>Etagère bois 20 x 60</option>
                                <option>Faïence mur 20 x 20</option>
                                <option>Joint poudre carrelage</option>
                                <option>Lot de colorants universels de peintre</option>
                                <option>Montant M48</option>
                                <option>Mortier colle poudre</option>
                                <option>Panneau bois (OSB ou aggloméré)</option>
                                <option>Papier de verre grain 120</option>
                                <option>Papier de verre grain 80</option>
                                <option>Peinture acrylique satinée</option>
                                <option>Peinture boiseries acrylique brillant</option>
                                <option>Peinture impression</option>
                                <option>Planche de coffrage</option>
                                <option>Plaque de Plâtre BA13</option>
                                <option>Plinthe MDF ou bois brut</option>
                                <option>Pointes tête homme</option>
                                <option>Portemanteau mural bois 2 têtes</option>
                                <option>Rail R48</option>
                                <option>Revêtement à peindre - toile de verre (largeur 1 m)</option>
                                <option>Serrure satandard encastrable  NF Cylindre européen</option>
                                <option>Serrure standard en L encastrable </option>
                                <option>Tablette bois</option>
                                <option>Tasseau raboté</option>
                                <option>Verrou à bouton - cylindre 40 mm</option>
                                <option>Vis à bois 30 mm</option>
                                <option>Vis TRPF</option>
                                <option>Vis TTPC 25</option>
                                <option>Vis TTPC 35</option>
                            </select>
                        </div>        
                        <div class="col-6">
                            <select class="form-select form-select-sm">
                                <option>-- Choisir une valeur --</option>
                                <option>Bande à joint</option>
                                <option>Bande armée à joint</option>
                                <option>Champlat</option>
                                <option>Chevilles à expansion avec patte à vis</option>
                                <option>Chevilles à frapper</option>
                                <option>Chevilles autoforeuses - Fixation plaque de plâtre</option>
                                <option>Chiffons</option>
                                <option>Colle acrylique de fixation pour plinthe</option>
                                <option>Colle pour toile de verre</option>
                                <option>Croisillons épaisseur 2 mm</option>
                                <option>Cylindre double entrée profil européen</option>
                                <option>Enduit à joint</option>
                                <option>Enduit de rebouchage</option>
                                <option>Ensemble de porte - Clé I</option>
                                <option>Ensemble de porte - Clé L</option>
                                <option>Ensemble intérupteur SA/VV - encastrable</option>
                                <option>Ensemble Prise 2P+T - encastrable</option>
                                <option>Etagère bois 20 x 60</option>
                                <option>Faïence mur 20 x 20</option>
                                <option>Joint poudre carrelage</option>
                                <option>Lot de colorants universels de peintre</option>
                                <option>Montant M48</option>
                                <option>Mortier colle poudre</option>
                                <option>Panneau bois (OSB ou aggloméré)</option>
                                <option>Papier de verre grain 120</option>
                                <option>Papier de verre grain 80</option>
                                <option>Peinture acrylique satinée</option>
                                <option>Peinture boiseries acrylique brillant</option>
                                <option>Peinture impression</option>
                                <option>Planche de coffrage</option>
                                <option>Plaque de Plâtre BA13</option>
                                <option>Plinthe MDF ou bois brut</option>
                                <option>Pointes tête homme</option>
                                <option>Portemanteau mural bois 2 têtes</option>
                                <option>Rail R48</option>
                                <option>Revêtement à peindre - toile de verre (largeur 1 m)</option>
                                <option>Serrure satandard encastrable  NF Cylindre européen</option>
                                <option>Serrure standard en L encastrable </option>
                                <option>Tablette bois</option>
                                <option>Tasseau raboté</option>
                                <option>Verrou à bouton - cylindre 40 mm</option>
                                <option>Vis à bois 30 mm</option>
                                <option>Vis TRPF</option>
                                <option>Vis TTPC 25</option>
                                <option>Vis TTPC 35</option>
                            </select>
                        </div>        
                        <div class="col-6">
                            <select class="form-select form-select-sm">
                                <option>-- Choisir une valeur --</option>
                                <option>Bande à joint</option>
                                <option>Bande armée à joint</option>
                                <option>Champlat</option>
                                <option>Chevilles à expansion avec patte à vis</option>
                                <option>Chevilles à frapper</option>
                                <option>Chevilles autoforeuses - Fixation plaque de plâtre</option>
                                <option>Chiffons</option>
                                <option>Colle acrylique de fixation pour plinthe</option>
                                <option>Colle pour toile de verre</option>
                                <option>Croisillons épaisseur 2 mm</option>
                                <option>Cylindre double entrée profil européen</option>
                                <option>Enduit à joint</option>
                                <option>Enduit de rebouchage</option>
                                <option>Ensemble de porte - Clé I</option>
                                <option>Ensemble de porte - Clé L</option>
                                <option>Ensemble intérupteur SA/VV - encastrable</option>
                                <option>Ensemble Prise 2P+T - encastrable</option>
                                <option>Etagère bois 20 x 60</option>
                                <option>Faïence mur 20 x 20</option>
                                <option>Joint poudre carrelage</option>
                                <option>Lot de colorants universels de peintre</option>
                                <option>Montant M48</option>
                                <option>Mortier colle poudre</option>
                                <option>Panneau bois (OSB ou aggloméré)</option>
                                <option>Papier de verre grain 120</option>
                                <option>Papier de verre grain 80</option>
                                <option>Peinture acrylique satinée</option>
                                <option>Peinture boiseries acrylique brillant</option>
                                <option>Peinture impression</option>
                                <option>Planche de coffrage</option>
                                <option>Plaque de Plâtre BA13</option>
                                <option>Plinthe MDF ou bois brut</option>
                                <option>Pointes tête homme</option>
                                <option>Portemanteau mural bois 2 têtes</option>
                                <option>Rail R48</option>
                                <option>Revêtement à peindre - toile de verre (largeur 1 m)</option>
                                <option>Serrure satandard encastrable  NF Cylindre européen</option>
                                <option>Serrure standard en L encastrable </option>
                                <option>Tablette bois</option>
                                <option>Tasseau raboté</option>
                                <option>Verrou à bouton - cylindre 40 mm</option>
                                <option>Vis à bois 30 mm</option>
                                <option>Vis TRPF</option>
                                <option>Vis TTPC 25</option>
                                <option>Vis TTPC 35</option>
                            </select>
                        </div>        
                        <div class="col-6">
                            <select class="form-select form-select-sm">
                                <option>-- Choisir une valeur --</option>
                                <option>Bande à joint</option>
                                <option>Bande armée à joint</option>
                                <option>Champlat</option>
                                <option>Chevilles à expansion avec patte à vis</option>
                                <option>Chevilles à frapper</option>
                                <option>Chevilles autoforeuses - Fixation plaque de plâtre</option>
                                <option>Chiffons</option>
                                <option>Colle acrylique de fixation pour plinthe</option>
                                <option>Colle pour toile de verre</option>
                                <option>Croisillons épaisseur 2 mm</option>
                                <option>Cylindre double entrée profil européen</option>
                                <option>Enduit à joint</option>
                                <option>Enduit de rebouchage</option>
                                <option>Ensemble de porte - Clé I</option>
                                <option>Ensemble de porte - Clé L</option>
                                <option>Ensemble intérupteur SA/VV - encastrable</option>
                                <option>Ensemble Prise 2P+T - encastrable</option>
                                <option>Etagère bois 20 x 60</option>
                                <option>Faïence mur 20 x 20</option>
                                <option>Joint poudre carrelage</option>
                                <option>Lot de colorants universels de peintre</option>
                                <option>Montant M48</option>
                                <option>Mortier colle poudre</option>
                                <option>Panneau bois (OSB ou aggloméré)</option>
                                <option>Papier de verre grain 120</option>
                                <option>Papier de verre grain 80</option>
                                <option>Peinture acrylique satinée</option>
                                <option>Peinture boiseries acrylique brillant</option>
                                <option>Peinture impression</option>
                                <option>Planche de coffrage</option>
                                <option>Plaque de Plâtre BA13</option>
                                <option>Plinthe MDF ou bois brut</option>
                                <option>Pointes tête homme</option>
                                <option>Portemanteau mural bois 2 têtes</option>
                                <option>Rail R48</option>
                                <option>Revêtement à peindre - toile de verre (largeur 1 m)</option>
                                <option>Serrure satandard encastrable  NF Cylindre européen</option>
                                <option>Serrure standard en L encastrable </option>
                                <option>Tablette bois</option>
                                <option>Tasseau raboté</option>
                                <option>Verrou à bouton - cylindre 40 mm</option>
                                <option>Vis à bois 30 mm</option>
                                <option>Vis TRPF</option>
                                <option>Vis TTPC 25</option>
                                <option>Vis TTPC 35</option>
                            </select>
                        </div>        
                        <div class="col-6">
                            <select class="form-select form-select-sm">
                                <option>-- Choisir une valeur --</option>
                                <option>Bande à joint</option>
                                <option>Bande armée à joint</option>
                                <option>Champlat</option>
                                <option>Chevilles à expansion avec patte à vis</option>
                                <option>Chevilles à frapper</option>
                                <option>Chevilles autoforeuses - Fixation plaque de plâtre</option>
                                <option>Chiffons</option>
                                <option>Colle acrylique de fixation pour plinthe</option>
                                <option>Colle pour toile de verre</option>
                                <option>Croisillons épaisseur 2 mm</option>
                                <option>Cylindre double entrée profil européen</option>
                                <option>Enduit à joint</option>
                                <option>Enduit de rebouchage</option>
                                <option>Ensemble de porte - Clé I</option>
                                <option>Ensemble de porte - Clé L</option>
                                <option>Ensemble intérupteur SA/VV - encastrable</option>
                                <option>Ensemble Prise 2P+T - encastrable</option>
                                <option>Etagère bois 20 x 60</option>
                                <option>Faïence mur 20 x 20</option>
                                <option>Joint poudre carrelage</option>
                                <option>Lot de colorants universels de peintre</option>
                                <option>Montant M48</option>
                                <option>Mortier colle poudre</option>
                                <option>Panneau bois (OSB ou aggloméré)</option>
                                <option>Papier de verre grain 120</option>
                                <option>Papier de verre grain 80</option>
                                <option>Peinture acrylique satinée</option>
                                <option>Peinture boiseries acrylique brillant</option>
                                <option>Peinture impression</option>
                                <option>Planche de coffrage</option>
                                <option>Plaque de Plâtre BA13</option>
                                <option>Plinthe MDF ou bois brut</option>
                                <option>Pointes tête homme</option>
                                <option>Portemanteau mural bois 2 têtes</option>
                                <option>Rail R48</option>
                                <option>Revêtement à peindre - toile de verre (largeur 1 m)</option>
                                <option>Serrure satandard encastrable  NF Cylindre européen</option>
                                <option>Serrure standard en L encastrable </option>
                                <option>Tablette bois</option>
                                <option>Tasseau raboté</option>
                                <option>Verrou à bouton - cylindre 40 mm</option>
                                <option>Vis à bois 30 mm</option>
                                <option>Vis TRPF</option>
                                <option>Vis TTPC 25</option>
                                <option>Vis TTPC 35</option>
                            </select>
                        </div>                
                    </div>
                </div>
            </fieldset>  
        </form>
        </div>
    </div>

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div id="modal-content-home" class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Personnalisation du champ</h1>
                <button id="#btn-cross-modal" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div id="modal-body-home" class="modal-body">
                <div class="container-fluid p-0">
                    <div class="row m-0 mb-3">
                            <div class="p-2 d-flex flex-column align-items-center border col-4">
                                <label class="form-label mb-0" for="modal-textColor">Couleur texte</label>
                                <input class="form-control form-control-color m-2" type="color" id="modal-fontColor">
                            </div>
                            <div class="p-2 form-switch d-flex flex-column align-items-center border col-4">
                                <label class="form-label mb-0 text-center" for="modal-tts">
                                    Text to speech
                                    <i id="modal-modiftts" class="ms-1 bi bi-pencil-square"></i>
                                </label>
                                <input class="form-check-input m-2" type="checkbox" role="switch" id="modal-tts">
                            </div>
                            <div class="p-2 d-flex flex-column align-items-center border col-4">
                                <label class="form-label mb-0" for="modal-bgColor">Couleur fond</label>
                                <input class="form-control form-control-color m-2" type="color" id="modal-bgColor">
                            </div>
                            <div class="col-6 border p-3">
                                <div class="row d-flex pb-2 m-0">
                                    <label for="modal-fontSizeInput" class="my-auto form-label col-10 p-0">Taille de la police</label>
                                    <input id="modal-fontSizeInput" type="text" class="col-2 p-0"> 
                                </div>
                                <input id="modal-fontSizeRange" min="8" max="50" step="0.5" type="range" class="form-range">
                            </div>
                            <div class="col-6 border p-3">
                                <label for="modal-fontFamily" class="pb-3">
                                    police
                                </label>
                                <select id="modal-fontFamily" class="form-select">
                                    <option value="'Arial', sans-serif" style="font-family: 'Arial', sans-serif;">Arial</option>
                                    <option value="'Brush Script MT', cursive" style="font-family: 'Brush Script MT', cursive;">Brush Script MT</option>
                                    <option value="'Comic Sans MS', cursive" style="font-family: 'Comic Sans MS', cursive;">Comic Sans MS</option>
                                    <option value="'Courier New', monospace" style="font-family: 'Courier New', monospace;">Courier New</option>
                                    <option value="'Garamond', serif" style="font-family: 'Garamond', serif;">Garamond</option>
                                    <option value="'Georgia', serif" style="font-family: 'Georgia', serif;">Georgia</option>
                                    <option value="'Impact', sans-serif" style="font-family: 'Impact', sans-serif;">Impact</option>
                                    <option value="'Lucida Console', monospace" style="font-family: 'Lucida Console', monospace;">Lucida Console</option>
                                    <option value="'Noto Sans', sans-serif" style="font-family: 'Noto Sans', sans-serif;">Noto Sans</option>
                                    <option value="'Palatino', serif" style="font-family: 'Palatino', serif;">Palatino</option>                                
                                    <option value="'Segoe UI', sans-serif" style="font-family: 'Segoe UI', sans-serif;">Segoe UI</option>
                                    <option value="'Times New Roman', serif" style="font-family: 'Times New Roman', serif;">Times New Roman</option>
                                    <option value="'Trebuchet MS', sans-serif" style="font-family: 'Trebuchet MS', sans-serif;">Trebuchet MS</option>
                                    <option value="'Verdana', sans-serif" style="font-family: 'Verdana', sans-serif;">Verdana</option>
                                </select>
                            </div>
                            <div class="p-2 form-switch d-flex flex-column align-items-center border col-2">
                                <label class="form-label mb-0 text-center" for="modal-bold">
                                    <i style="font-size: 1.5rem;" class="bi bi-type-bold"></i>
                                </label>
                                <input class="form-check-input m-2" type="checkbox" role="switch" id="modal-bold">
                            </div>
                            <div class="col-8 p-2 text-center border">
                                <label class="form-label">Niveau</label>
                                <div id="modal-level" class="d-flex justify-content-around py-2">
                                    <div class="form-check">
                                        <label for="modal-level-1" class="form-check-label">1</label>
                                        <input id="modal-level-1" type="radio" class="modal-level form-check-input" name="level">
                                    </div>
                                    <div class="form-check">
                                        <label for="modal-level-2" class="form-check-label">2</label>
                                        <input id="modal-level-2" type="radio" class="modal-level form-check-input" name="level">
                                    </div>
                                    <div class="form-check">
                                        <label for="modal-level-3" class="form-check-label">3</label>
                                        <input id="modal-level-3" type="radio" class="modal-level form-check-input" name="level">
                                    </div>
                                    <div class="form-check">
                                        <label for="modal-level-4" class="form-check-label">4</label>
                                        <input id="modal-level-4" type="radio" class="modal-level form-check-input" name="level">
                                    </div>
                                </div>
                            </div>
                            <div class="p-2 form-switch d-flex flex-column align-items-center border col-2">
                                <label class="form-label mb-0 text-center" for="modal-italic">
                                    <i style="font-size: 1.5rem;" class="bi bi-type-italic"></i>
                                </label>
                                <input class="form-check-input m-2" type="checkbox" role="switch" id="modal-italic">
                            </div>
                        </div>
                    <div class="row m-0">
                        <!--
                        <div class="col-12 p-3 border border-black border-2 rounded">
                            <label for="currentInput" class="form-label"></label>
                            <input id="currentInput" class="form-control" type="text">
                        </div>
                        -->
                        <div class="col-12 d-flex flex-column justify-content-end p-3 border border-black border-2 rounded">
                            <div class="div-img d-flex justify-content-center mb-1">
                                <img class="border border-black rounded border-2 h-auto w-auto object-fit-contain">
                            </div>
                            <label for="currentInput2" class="form-label mb-0"></label>
                            <div class="div-input input-group">
                                <input id="currentInput2" class="form-control" type="text">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" id="btn-modal-cancel" class="btn btn-danger" data-bs-dismiss="modal"><i class="pe-2 bi bi-x-circle"></i>Annuler</button>
                <button type="button" id="btn-modal-confirm" class="btn btn-success" data-bs-dismiss="modal"><i class="pe-2 bi bi-check-circle"></i>Valider</button>
            </div>
            </div>
            <div id="modal-content-tts" class="d-none modal-content">
                <div id="modal-body-tts" class="modal-body">
                    <div class="d-flex justify-content-between mb-3">
                        <label for="textArea-modiftts" class="my-auto form-label">Modification du texte à lire</label>
                        <button type="button" class="btn btn-primary text-light">
                            <i class="bi bi-volume-up"></i>
                        </button>
                    </div>
                    <textarea id="textArea-modiftts" class="form-control" rows="10"></textarea>
                    <div id="div-buttons" class="mt-3 d-flex justify-content-end">
                        <button type="button" id="btn-tts-cancel" class="me-3 btn btn-danger">
                            Annuler
                            <i class="bi bi-x-circle"></i>
                        </button>
                        <button type="button" id="btn-tts-confirm" class="btn btn-success">
                            Valider
                            <i class="bi bi-check-circle"></i>
                        </button>
                    </div>
                </div>
            </div>
            <div id="modal-content-pictos" class="d-none modal-content">
                <div class="modal-header">
                    <h1 class="modal-title fs-5">Modification du pictogramme</h1>
                    <button type="button" class="btn-close" aria-label="Close"></button>
                </div>
                <div id="modal-body-pictos" class="modal-body">
                    <div class="container-fluid p-0">
                        <div class="row g-3">
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<template id="template-hover">
    <div class="d-flex position-absolute top-50 start-50 translate-middle div-hover opacity-100">
        <button type="button" class="m-2 text-light btn btn-sm btn-primary rounded-circle">
            <i class="bi bi-volume-up"></i>
        </button>
        <button type="button" class="m-2 text-light btn btn-sm btn-primary rounded-circle">
            <i class="bi bi-eye"></i>
        </button>
        <button type="button" class="m-2 text-light btn btn-sm btn-primary rounded-circle" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
            <i class="bi bi-pencil"></i>
        </button>
    </div>
</template>
<template id="template-modal">
    <div class="d-flex flex-column justify-content-end p-3 border border-black border-2 rounded">
        <div class="div-img d-flex justify-content-center mb-1">
            <img class="border border-black rounded border-2  h-auto w-auto object-fit-contain">
        </div>
        <label for="currentInput2" class="form-label mb-0"></label>
        <div class="div-input input-group">
            <input id="currentInput2" class="form-control" type="text">
        </div>
    </div>  
</template>

<script>
    const datas = <?= $datas ?>;
    console.log(datas);
    const pictos = <?= $pictos ?>;
    console.log(pictos);
</script>

<?php
$content = ob_get_clean();
require("../app/views/layout.php");
?>


