<?php

require 'require/header.php';
require 'require/commun.php';

$uploadErr = "";
$sortieM = new SortieManager();

$sortieM->delete_sortie($_GET["id_sortie"]);


if (!$uploadErr) {


    header("Location: index.php?action=accueil&mess=Sortie supprimée");
} else {
    header("Location: index.php?action=accueil&mess=$uploadErr");
}
?>