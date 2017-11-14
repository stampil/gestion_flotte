<?php
require 'require/header.php';
require 'require/commun.php';

$uploadErr="";

if(!$USER){
    $uploadErr="Veuillez vous reconnecter";
}
else{
    $joueurM = new JoueurManager($bdd);

    foreach($_POST['forceAbsent'] as $id_joueur =>$on){
		
		$joueurM->set_sortie($_POST["id_sortie"], $id_joueur, 0, '', 'Mis en absent par l\'organisateur ou un administrateur');
	}

}
if (!$uploadErr) {
    header("Location: index.php?action=accueil&mess=Sortie enregistrée");
} else {
    header("Location: index.php?action=accueil&mess=$uploadErr");
}
?>