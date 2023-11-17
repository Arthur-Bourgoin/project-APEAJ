<?php
$bsIcons = true;
$scripts = "<script src='/assets/js/app.js' type='module'></script>";
$title = "Création fiche";

ob_start();
?>

<body class="container">
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
                        <div id="div-studentLastName" class="col-6 py-2 position-relative" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            <div class="div-label">
                                <label for="nomIntervenant" class="form-label mb-0">Nom de l'intervenant</label>
                            </div>
                            <div class="div-input">
                                <input id="nomIntervenant" class="form-control pe-none" type="text">
                            </div>
                        </div>
                        <div id="div-studentFirstName" class="col-6 py-2 position-relative" data-bs-toggle="modal" data-bs-target="#staticBackdrop">
                            <div class="div-label">
                                <label for="prenomIntervenant" class="form-label mb-0">Prénom de l'intervenant</label>
                            </div>
                            <div class="div-input">
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
            <div class="modal-content">
            <div class="modal-header">
                <h1 class="modal-title fs-5" id="staticBackdropLabel">Personnalisation du champ</h1>
                <button id="btn-cross-modal" type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <div class="container-fluid">
                    <div class="row mb-3">
                        <div class="d-flex">
                            <div class="p-2 d-flex flex-column align-items-center border">
                                <label class="form-label mb-0" for="modal-textColor">Couleur texte</label>
                                <input class="form-control form-control-color m-2" type="color" id="modal-textColor">
                            </div>
                            <div class="p-2 form-switch d-flex flex-column align-items-center border">
                                <label class="form-label mb-0 text-center" for="modal-tts">Text to speech</label>
                                <input class="form-check-input m-2" type="checkbox" role="switch" id="modal-tts">
                            </div>
                            <div class="p-2 d-flex flex-column align-items-center border">
                                <label class="form-label mb-0" for="modal-bgColor">Couleur fond</label>
                                <input class="form-control form-control-color m-2" type="color" id="modal-bgColor">
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12 p-3 border border-black border-2 rounded">

                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger" data-bs-dismiss="modal"><i class="pe-2 bi bi-x-circle"></i>Annuler</button>
                <button type="button" class="btn btn-success" data-bs-dismiss="modal"><i class="pe-2 bi bi-check-circle"></i>Valider</button>
            </div>
        </div>
    </div>
</div>

<?php
$content = ob_get_clean();
require("../app/views/layout.php");
?>


