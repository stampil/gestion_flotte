<?php
$menu_actif='class="actif"';


?>

<link rel="stylesheet" href="css/menu.css" type="text/css" media="screen" />
<script src='js/menu.js'></script>
<div id="menu">
    <div <?php if($action=='accueil') echo $menu_actif ?> action="accueil">Accueil</div>
    <div <?php if($action=='connexion') echo $menu_actif ?> action="connexion">Connexion</div>
    <?php
    if(is_connected("ADMIN")){   
    ?>
    <div <?php if($action=='ajout_constructeur') echo $menu_actif ?> action="ajout_constructeur">Ajout constructeur</div>
    <div <?php if($action=='ajout_orientation') echo $menu_actif ?> action="ajout_orientation">Ajout orientation</div>
    <div <?php if($action=='ajout_vaisseau') echo $menu_actif ?> action="ajout_vaisseau">Ajout vaisseau</div>
    
    <?php } 
     if(!is_connected() || is_connected("ADMIN")){
    ?>
    <div <?php if($action=='ajout_team') echo $menu_actif ?> action="ajout_team">Ajout team</div>
    <div <?php if($action=='ajout_joueur') echo $menu_actif ?> action="ajout_joueur">Ajout joueur</div>
    <?php }
    if(is_connected()){
    ?>
    <div <?php if($action=='modif_joueur') echo $menu_actif ?> action="modif_joueur">Modif joueur</div>
    <div <?php if($action=='voir_team') echo $menu_actif ?> action="voir_team">Infos Team</div>
    <div <?php if($action=='voir_groupe_alliance') echo $menu_actif ?> action="voir_groupe_alliance">Infos groupe d'alliance</div>
    <?php
    }  
    if(is_connected("LOCKER")){
        ?>
    <div <?php if($action=='ajout_alliance') echo $menu_actif ?> action="ajout_alliance">Ajout alliance</div>
    <div <?php if($action=='ajout_alliance_team') echo $menu_actif ?> action="ajout_alliance_team">Ajout alliance team</div>
    <div <?php if($action=='ajout_groupe_alliance') echo $menu_actif ?> action="ajout_groupe_alliance">Ajout groupe d'alliance</div>
    <?php }
    if(is_connected("ADMIN")){
        ?>
    <div action="test">Test</div>
     <?php }
    ?>
</div>
