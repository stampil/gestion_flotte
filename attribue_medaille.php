<?php
session_start();
require 'require/header.php';
require 'require/commun.php';

if(!$USER){
	$uploadErr ="Vous devez etre connecté.";
}


if (!$uploadErr) {
    $decoM = new DecorationManager();
    $decoM->give_medaille($_POST["id_joueur"],$_POST["id_medaille"],$_POST["id_groupe"]);
	
    header("Location: index.php?action=attribuer_medaille&msg=médaille+attribuée");
} else {
    header("Location: index.php?action=accueil&mess=$uploadErr");
}


?>