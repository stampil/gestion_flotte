<?php

require 'require/header.php';
require 'require/commun.php';

$uploadErr = "";
$sortieM = new SortieManager();


$debut = $_GET["date"] . " " . $_GET["debut"] . ":00";
if ($_GET["fin"] <= $_GET["debut"]) {

    $date = new DateTime($_GET["date"]);
    $date->add(new DateInterval('P1D'));
    $fin = $date->format('Y-m-d') . " " . $_GET["fin"] . ":00";
} else {
    $fin = $_GET["date"] . " " . $_GET["fin"] . ":00";
}

$sortie = new Sortie((object) array(
            "titre" => $_GET["titre"],
            "detail" => $_GET["detail"],
            "id_sortie" => @$_GET["id_sortie"],
            "id_joueur" => $USER->get_id(),
            "id_teamspeak" => $_GET["id_teamspeak"],
            "debut" => $debut,
            "fin" => $fin,
            "creato" =>null,
            "modifo" =>null,
            "max_joueur"=> $_GET["max_joueur"],
            "visibilite" => $_GET["visibilite"]
        ));

if (@$_GET["id_sortie"]) {

    $sortieM->update_sortie($sortie);
} else {
    $id_sortie = $sortieM->set_sortie($sortie);
    $joueurM = new JoueurManager($bdd);  
    $id_jv = $_GET["id_jv"];
    $joueurM->set_sortie($id_sortie, $USER->get_id(), $id_jv, 'Organisateur');

}





if (!$uploadErr) {


    header("Location: index.php?action=accueil&mess=Sortie enregistrée");
} else {
    header("Location: index.php?action=accueil&mess=$uploadErr");
}
?>