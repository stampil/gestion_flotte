<?php
require 'require/header.php';
require 'require/commun.php';


list($uploadErr,$img) = upload_img("img", "joueur");

if(isset($_POST["select_teamP_joueur"][0]) && $_POST["select_teamP_joueur"][0]){
  echo "--post team joueur--";
    $teamM = new TeamManager();
    $team = $teamM->get_team($_POST["select_teamP_joueur"][0]);
    print_r($team);
    /*
     * l'api officiel retourne ok si c'est le pseudo egalement... :/
     */
    $check_handle = API("orgs/getOrgMembers",'{"search": "'.$_POST["handle"].'","symbol": "'.$team[0]->tag.'"}');
    var_dump($check_handle);
    echo "search: ".$_POST["handle"]." symbol: ".$team[0]->tag;
    if(isset($check_handle->data->totalrows) && $check_handle->data->totalrows != 1){
        echo "err1";
        $uploadErr.= "<p>Handle ".$_POST["handle"]." non reconnu dans la team ".$team[0]->tag." </p>";
    }
    if( isset($check_handle->success) && !$check_handle->success && isset($check_handle->msg)){
        $uploadErr.= $check_handle->msg;
        echo "err2";
    }
    
    if(!Joueur::check_handle($_POST["handle"])){
      $uploadErr.= "<p>Handle non reconnu </p>";
    }
    
}
else{
     $uploadErr.= "<p>Vous devez faire partie d'une team pour utiliser cet outil.</p>";
}



$joueur = new Joueur((object) array(
            "id_joueur" => null,
            "handle" => $_POST["handle"],
            "email" => $_POST["email"],
            "admin" => 0,
            "mdp" => $crypt->crypte($_POST["mdp"]),
            "creato" => null,
            "lastco" => null,
            "img" => $img
        ));

if (!$uploadErr) {
    echo "pas d'erreur !";
    @unlink("upload/joueur/".$img);
    exit();
    $joueurM = new JoueurManager();
    $id_joueur = $joueurM->set_joueur($joueur);

    if(!$id_joueur){
        header("Location: index.php?action=accueil&mess=Joueur non enregistre, surement car existe deja");
        exit();
    }
    $joueur->set_id($id_joueur);
    $joueurM->set_orientation($id_joueur, $_POST["select_orientation_joueur"]);
    $joueurM->set_vaisseau_global($id_joueur, $_POST["nb_vaiss"]);
    $joueurM->set_team($id_joueur, $_POST["select_teamP_joueur"], $_POST["select_teamS_joueur"]);

    $_SESSION["sjoueur"] =  serialize($joueur);
    header("Location: index.php?action=modif_joueur");
} else {
    @unlink("upload/joueur/".$img);
    header("Location: index.php?action=accueil&mess=$uploadErr");
}
?>