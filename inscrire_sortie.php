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
	if($_GET["presence"]==2){
		$id_jv = $_GET["id_jv2"];
	}
	
	//si on modifie son inscription il faut regarder que tout les autres vaisseaux qu'on a n'etait pas un vaisseau selectionné par un participant, si c le cas, il faut editer la participation de l'autre mec avec un id_jv a -1
	$v = $joueurM->get_vaisseau($USER->get_id());
	$id_sortie = $_GET["id_sortie"];
	$sortieM = new SortieManager();
	$participants = $sortieM->get_participant($id_sortie);

	foreach ($participants as $participant) {
		if(!$participant->id_jv){
			continue;
		}
		if($participant->id_joueur ==  $USER->get_id()){
			continue;
		}
		echo "test ".$participant->id_joueur." avec ".$participant->id_jv;
		
		$joueur = new Joueur($joueurM->get_joueur($participant->id_joueur));

		foreach($v as $info_vaisseau){
			echo "<br> test vaisseau moi ".$info_vaisseau->id_jv;
			if($participant->id_jv == $info_vaisseau->id_jv){
				//un mec avait le vaisseau de se joueur, si ce n'est pas l'id_jv d'inscription, on maj le mec
				if($participant->id_jv != $id_jv ){
					echo "un autre mec  avait le vaisseau de se joueur, si ce n'est pas l'id_jv d'inscription, on maj le mec";
					$joueurM->set_sortie($_GET["id_sortie"], $participant->id_joueur, -1, 0, '');
					mail($joueur->get_email(),'gestionnaire flotte starcitizen','Le vaisseau dont vous etiez un membre d\'equipage n\'est plus disponible, veuillez choisir un autre vaisseau : http://vps36292.ovh.net/mordu/flottes/index.php?action=voir_sortie&sortie='.$_GET["id_sortie"]);
				}
			}
		}
	}
	
	
    $joueurM->set_sortie($_GET["id_sortie"], $USER->get_id(), $id_jv, $_GET["role"], $_GET["commentaire"]);

}
if (!$uploadErr) {
    header("Location: index.php?action=accueil&mess=Sortie enregistrée");
} else {
    header("Location: index.php?action=accueil&mess=$uploadErr");
}
?>