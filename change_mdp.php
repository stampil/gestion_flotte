<?php

require 'require/header.php';
require 'require/commun.php';
$uploadErr=null;

$email = $_POST["email"];
$auth =$_POST["auth"];
$mdp = $_POST["mdp"];
if(!$email){
  $uploadErr="vous devez ecrire un email";  
}
$test = $crypt->crypte($email."toutestok".date("Ymd"));
if($test != $auth){
    $uploadErr="l'authentification n'est plus valide, veuillez recommencer le processus de récupération du mot de passe";  
}

$joueurM = new JoueurManager();
if(!$joueurM->is_email_in_bdd($email)){
    $uploadErr="cet email $email n'existe pas"; 
}


if (!$uploadErr) {
    $joueurM->change_mdp($crypt->crypte($mdp), $email);
    header("Location: index.php?action=accueil&mess=Votre mot de passe a été changé");
} else {
    header("Location: index.php?action=accueil&mess=$uploadErr");
}
?>