<?php
session_start();
require 'require/header.php';
require 'require/commun.php';

$uploadErr="";
if(!$USER){
	$uploadErr ="Vous devez etre connecté.";
}


if (!$uploadErr) {
    $decoM = new DecorationManager();
    $decoM->remove_insigne($_POST["id_joueur"],$_POST["id_insigne"],$_POST["id_groupe"]);

    header("Location: index.php?action=desattribuer_insigne&msg=insigne+desattribué");
} else {
    header("Location: index.php?action=accueil&mess=$uploadErr");
}


?>