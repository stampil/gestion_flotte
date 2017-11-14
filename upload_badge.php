<?php
require 'require/header.php';
require 'require/commun.php';

list($uploadErr,$img) = upload_img("img", "badge");


$deco = new Decoration( (object) array(
"nom"=>$_POST["nom"],
"description"=>$_POST["description"],
"img"=>$img
));

if (!$uploadErr) {
    $decoM = new DecorationManager();
    $decoM->set_badge($deco);
    header("Location: index.php?action=ajout_badge");
} else {
    header("Location: index.php?action=accueil&mess=$uploadErr");
}


?>