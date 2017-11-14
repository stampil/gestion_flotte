<?php
require 'require/header.php';
require 'require/commun.php';



$uploadErr=false;
if(isset($_FILES["img"]["name"]) && $_FILES["img"]["name"]){
    unlink("upload/joueur/".$USER->get_img());
    list($uploadErr,$img) = upload_img("img", "joueur");
    $USER->set_img($img);
    $_SESSION["sjoueur"] = serialize($USER);
}
else{
    $img = $USER->get_img();
}
if(!is_connected()) $uploadErr="Perte de connection...";

$mdp = $crypt->crypte($_POST["mdp"]);
if($mdp != $USER->get_mdp())  $uploadErr="Mauvais mot de passe...";

if($_POST["mdp2"]) $mdp = $crypt->crypte($_POST["mdp2"]);


$joueur = new Joueur((object) array(
            "id_joueur" => $USER->get_id(),
            "handle" => $USER->get_handle(),
            "email" => $_POST["email"],
            "admin" => $USER->get_admin(),
            "mdp" => $mdp,
            "creato" => $USER->get_creato(),
            "lastco" => $USER->get_lastco(),
            "img" => $img
        ));

if (!$uploadErr) {
    $joueurM = new JoueurManager();
    $joueurM->update_joueur($joueur);
    $joueurM->set_orientation($USER->get_id(), @$_POST["select_orientation_joueur"]);
    if(@$_POST["ajout_vaisseau"]){
        if($_POST["LTI"][0]) $LTI=1;
        else $LTI =0;
        $joueurM->set_vaisseau($USER->get_id(), (object) array("nom"=>$_POST["nom"][0],"LTI" =>$LTI, "id_vaisseau" => $_POST["ajout_vaisseau"] ));
    }


    foreach($_POST["date_dispo"] as $id => $value){
        if(isset($_POST["LTI"][$id]) && $_POST["LTI"][$id]){
        $LTI=1;
    }
    else{
        $LTI=0;
    }
    $joueurM->update_vaisseau($USER->get_id(), (object) array(
        "nom"=>$_POST["nom"][$id],
        "LTI" =>$LTI,
        "date_dispo"=>$_POST["date_dispo"][$id],
        "cargo"=>$_POST["cargo"][$id],
        "autonomie"=>$_POST["autonomie"][$id],
        "coutReparation"=>$_POST["coutReparation"][$id],
        "id_vaisseau" => $id
    ));
    }
    

    
    $joueurM->set_team($USER->get_id(), @$_POST["select_teamP_joueur"], @$_POST["select_teamS_joueur"]);
	
	$joueurM->reset_deco($USER->get_id());
	
	$medailles = @$_POST["medailles"];
	if(is_array($medailles)){
        foreach ($medailles as $id_groupe => $tab_medaille){
            foreach ($tab_medaille as $id_medaille => $affiche){
                if($affiche) $affiche =1;
                $joueurM->affiche_medaille($USER->get_id(),$id_medaille,$id_groupe,$affiche);
            }
        }
	}
	
	$rubans = @$_POST["rubans"];
	if(is_array($rubans)){
        foreach ($rubans as $id_groupe => $tab_ruban){
            foreach ($tab_ruban as $id_ruban => $affiche){
                if($affiche) $affiche =1;
                $joueurM->affiche_ruban($USER->get_id(),$id_ruban,$id_groupe,$affiche);
            }
        }
	}
	
	$insignes = @$_POST["insignes"];
	if(is_array($insignes)){
        foreach ($insignes as $id_groupe => $tab_insigne){
            foreach ($tab_insigne as $id_insigne => $affiche){
                if($affiche) $affiche =1;
                $joueurM->affiche_insigne($USER->get_id(),$id_insigne,$id_groupe,$affiche);
            }
        }
	}


    
    $_SESSION["sjoueur"]=  serialize($joueur);
    
    header("Location: index.php?action=modif_joueur");
} else {
   header("Location: index.php?action=accueil&mess=$uploadErr");
}
?>