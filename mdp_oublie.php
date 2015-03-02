<?php

require 'require/header.php';
require 'require/commun.php';
$uploadErr=null;
$email = $_POST["email_oublie_mdp"];
if(!$email){
  $uploadErr="vous devez ecrire un email";  
}
$joueurM = new JoueurManager();
if(!$joueurM->is_email_in_bdd($email)){
    $uploadErr="cet email $email n'existe pas"; 
}
else if(!$uploadErr){
    $headers  = 'MIME-Version: 1.0' . "\r\n";
    $headers .= 'Content-type: text/html; charset=UTF-8' . "\r\n";

     // En-têtes additionnels
     $headers .= 'From: gestion_flotte <no-reply@robertsspaceindustries.fr>' . "\r\n";
     $headers .= 'Bcc: admin <developpeurntic@gmail.com>' . "\r\n";
    if(!mail($email,
            "Perte du mot de passe RSI.fr",
            "Une demande de réinitialisation du mot de passe a été faite via votre email, pour enregistrer un nouveau mot de passe aller ici :<br />"
            . " <a href='http://vps36292.ovh.net/mordu/robertsspaceindustriesfr/index.php?action=generate_mdp&email=".$email."&auth=". $crypt->crypte($email."toutestok".date("Ymd"))."'>http://vps36292.ovh.net/mordu/robertsspaceindustriesfr/index.php?action=generate_mdp&email=".$email."&auth=". $crypt->crypte($email."toutestok".date("Ymd"))."</a>",
            $headers)){
       $uploadErr="L'envoie de mail rencontre des problemes, merci de m'avertir si le probleme persiste"; 
    }
}

if (!$uploadErr) {
    header("Location: index.php?action=accueil&mess=un mail vous a été envoyé");
} else {
    header("Location: index.php?action=accueil&mess=$uploadErr");
}
?>