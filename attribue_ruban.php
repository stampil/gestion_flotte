<?php
session_start();
require 'require/header.php';
require 'require/commun.php';

if(!$USER){
	$uploadErr ="Vous devez etre connecté.";
}


if (!$uploadErr) {
    $decoM = new DecorationManager();
    $decoM->give_ruban($_POST["id_joueur"],$_POST["id_ruban"],$_POST["id_groupe"]);

    header("Location: index.php?action=attribuer_ruban&msg=ruban+attribué");
} else {
    header("Location: index.php?action=accueil&mess=$uploadErr");
}


?>