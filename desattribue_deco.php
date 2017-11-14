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
    
    $remove_deco = @$_POST['remove_insigne'];
    if($remove_deco){
        foreach ($remove_deco as $value) {
            $tab = explode(',', $value);
            $decoM->remove_insigne($tab[2],$tab[0],$tab[1]);
        }
    }
    
        $remove_deco = @$_POST['remove_medaille'];
    if($remove_deco){
        foreach ($remove_deco as $value) {
            $tab = explode(',', $value);
            $decoM->remove_medaille($tab[2],$tab[0],$tab[1]);
        }
    }
    
        $remove_deco = @$_POST['remove_ruban'];
    if($remove_deco){
        foreach ($remove_deco as $value) {
            $tab = explode(',', $value);
            $decoM->remove_ruban($tab[2],$tab[0],$tab[1]);
        }
    }
    

    header("Location: index.php?action=desattribuer_deco&msg=insigne+desattribué");
} else {
    header("Location: index.php?action=accueil&mess=$uploadErr");
}


?>