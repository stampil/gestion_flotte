<?php
require 'require/header.php';
require 'require/commun.php';

$uploadErr="";

if(!$USER){
    $uploadErr="Veuillez vous reconnecter";
}
else{
    $joueurM = new JoueurManager($bdd);
    
    $id_jv = $_GET["id_jv"];
    if(!$_GET["presence"]){
        $id_jv=0;
    }

    $joueurM->set_sortie($_GET["id_sortie"], $USER->get_id(), $id_jv, $_GET["role"], $_GET["commentaire"]);

}
if (!$uploadErr) {
    header("Location: index.php?action=accueil&mess=Sortie enregistrée");
} else {
    header("Location: index.php?action=accueil&mess=$uploadErr");
}
?>