<?php
chdir("../");
require 'require/header.php';
require 'require/commun.php';

$sortieM = new SortieManager();
$id_sortie = @$_POST["id_sortie"];
$organisateur = $sortieM->get_organisateur($id_sortie);
    
if(!$USER || $organisateur != $USER->get_id()){
    echo $USER->get_id();
    echo " != $organisateur ";
    exit("err");
}

$sortieM->set_formation($_POST["id_joueur"],
        $id_sortie,
        $_POST["x"],
        $_POST["y"],
        $_POST["num"]=='L'?1:$_POST["num"],
        $_POST["couleur"],
        $_POST["is_vip"]=='true'?1:0);
?>