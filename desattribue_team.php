<?php
session_start();
require 'require/header.php';
require 'require/commun.php';

$uploadErr="";
if(!$USER){
	$uploadErr ="Vous devez etre connecté.";
}


if (!$uploadErr) {
    $joueurM = new JoueurManager();
    
    $remove_team = @$_POST['remove_team'];
    if($remove_team){
        foreach ($remove_team as $id_team) {
            
            $joueurM->remove_team($id_team);
        }
    }
    

    

    header("Location: index.php?action=desattribuer_team&msg=joueur+déguildé");
} else {
    header("Location: index.php?action=accueil&mess=$uploadErr");
}


?>