<?php
require 'require/header.php';
require 'require/commun.php';

list($uploadErr,$img) = upload_img("img", "vaisseau");


$vaisseau = new Vaisseau( (object) array(
"nom"=>$_POST["nom"],
"id_constructeur"=>$_POST["id_constructeur"],
"focus"=>$_POST["focus"], 
"cargo"=>$_POST["cargo"], 
"autonomie"=>$_POST["autonomie"], 
"coutReparation"=>$_POST["coutReparation"],
"nbEquipage"=>$_POST["nbEquipage"],
"img"=>$img
));

if (!$uploadErr) {
    $vaisseauM = new VaisseauManager();
    $vaisseauM->set_vaisseau($vaisseau);
    header("Location: index.php?action=ajout_vaisseau");
} else {
    header("Location: index.php?action=accueil&mess=$uploadErr");
}


?>