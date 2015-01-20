<?php
require 'require/header.php';
require 'require/commun.php';

$uploadErr="";
$sortieM = new SortieManager();


$debut = $_GET["date"]." ".$_GET["debut"].":00";
if($_GET["fin"]<=$_GET["debut"]){
    
    $date = new DateTime($_GET["date"]);
    $date->add(new DateInterval('P1D'));
    $fin =  $date->format('Y-m-d') ." ".$_GET["fin"].":00";
}
else{
    $fin =  $_GET["date"]." ".$_GET["fin"].":00";
}


$sortie = new Sortie((object) array(
    "titre" =>$_GET["titre"],
    "detail" =>$_GET["detail"],
    "id_sortie" => 0,
    "id_joueur" =>$USER->get_id(),
    "id_teamspeak" =>$_GET["id_teamspeak"],
    "debut" => $debut,
    "fin" => $fin,
    "visibilite" =>$_GET["visibilite"]
 ));
$sortieM->set_sortie($sortie);




if (!$uploadErr) {


    header("Location: index.php?action=accueil&mess=Sortie enregistrée");
} else {
    header("Location: index.php?action=accueil&mess=$uploadErr");
}
?>