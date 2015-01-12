<?php
$menu_actif='actif';
?>

<link rel="stylesheet" href="css/menu.css" type="text/css" media="screen" />
<script src='js/menu.js'></script>

<table width="440" border="0" align="center" cellpadding="0" cellspacing="0">
                    <tr>
                        <td><div align="center" class="menu <?php if($action=='accueil') echo $menu_actif ?>" action=accueil><a href="?action=accueil">accueil</a></div></td>
                        <td></td>
                        
                        <?php 
     if(!is_connected() || is_connected("ADMIN")){
    ?>
                        <td><div align="center" class="menu <?php if($action=='ajout_joueur') echo $menu_actif ?>" action=ajout_joueur><a href="?action=ajout_joueur">s'ajouter</a></div></td>
                        <td></td>
                        <td><div align="center" class="menu <?php if($action=='ajout_team') echo $menu_actif ?>" action=ajout_team><a href="?action=ajout_team">Ajouter une team</a></div></td>
                        <td></td>
                        <td></td>
                        <td><div align="center" class="menu" <?php if($action=='connexion') echo $menu_actif ?> action=connexion><a href="?action=connexion">Connexion</a></div></td>
     <?php }
                            if(is_connected()){
                        ?>
                        
                        <td><div align="center" class="menu  <?php if($action=='modif_joueur') echo $menu_actif ?>" action=modif_joueur><a href="?action=modif_joueur">Modif infos</a></div></td>
                        <td></td>    
                        <td><div align="center" class="menu  <?php if($action=='voir_team') echo $menu_actif ?>" action=voir_team><a href="?action=voir_team">Info Team</a></div></td>
                        <td></td>    
                        <td><div align="center" class="menu  <?php if($action=='voir_groupe_alliance') echo $menu_actif ?>" action=voir_groupe_alliance><a href="?action=voir_groupe_alliance">Info Gr Alliance</a></div></td>
    
                            <?php } ?>
                        
                        
                    </tr>
</table>




<div id="menu" style="display:none">

    <?php
    if(is_connected("ADMIN")){   
    ?>
    <div <?php if($action=='ajout_constructeur') echo $menu_actif ?> action="ajout_constructeur">Ajout constructeur</div>
    <div <?php if($action=='ajout_orientation') echo $menu_actif ?> action="ajout_orientation">Ajout orientation</div>
    <div <?php if($action=='ajout_vaisseau') echo $menu_actif ?> action="ajout_vaisseau">Ajout vaisseau</div>
    
    <?php } 
     if(!is_connected() || is_connected("ADMIN")){
    ?>

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
