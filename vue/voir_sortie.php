<pre><?php
if(!is_connected()) exit("veuillez vous (re)connectez");

$id_sortie = $_GET['sortie'];

$sortieM = new SortieManager();
$sortie = new Sortie($sortieM->get_sortie($id_sortie));

$teamspeakM = new TeamspeakManager($bdd);
$teamspeak = $teamspeakM->get_all_teamspeak();

?>
<p>Info sortie</p>

<form action="upload_sortie.php" method="get">
<table>
    <tr>
        <td>Titre</td>
        <td><input type="text" readonly="readonly" name="titre" value="<?php echo $sortie->get_titre() ?>"/></td>
    </tr>
    <tr>
        <td>Detail</td>
        <td><textarea name="detail" readonly="readonly"><?php echo $sortie->get_detail() ?></textarea></td>
    </tr>
    <tr>
        <td>Organisateur</td>
        <td><input type="text" readonly="readonly" value="[<?php

		echo $sortie->get_organisateur()->get_team()->get_tag().'] '.$sortie->get_organisateur()->get_handle();
					?>" /></td>
    </tr>
    <tr>
        <td>Teamspeak</td>
        <td><select name="id_teamspeak" disabled="disabled">
            <?php
            
             foreach ($teamspeak as $o) {

                 echo '<option value="'.$o->id_teamspeak.'" '.($o->id_teamspeak==$sortie->get_id_teamspeak()?'selected="selected"':'').'>'.$o->label.'</option>';
             }
            ?>
            </select></td>
    </tr>
    <tr>
        <td>Date</td>
        <td><input  type="text" readonly="readonly" value="<?php echo $jours[date("w",  strtotime($sortie->get_debut()))]." ".date("d/m",  strtotime($sortie->get_debut())); ?>" />
        <input type="hidden" name="date"  value="<?php echo date("Y-m-d",  strtotime($sortie->get_debut())); ?>" /></td>
    </tr>
    <tr>
        <td>Début</td>
        <td><input name="debut" type="time"  value="<?php echo usdatetotimeus($sortie->get_debut()); ?>" readonly="readonly"/></td>
    </tr>
    <tr>
        <td>Fin</td>
        <td><input name="fin" type="time"  value="<?php echo usdatetotimeus($sortie->get_fin()); ?>" readonly="readonly" /></td>
    </tr>
    <tr>
        <td>Inscription possible par</td>
        <td><select name="visibilite" disabled="disabled">
                <option value="<?php echo SORTIE_VISIBILITE_TEAM; ?>" <?php if($sortie->get_visibilite()==SORTIE_VISIBILITE_TEAM) echo 'selected="selected"' ?>>Team seulement</option>
                <option value="<?php echo SORTIE_VISIBILITE_TEAM_ALLIE; ?>" <?php if($sortie->get_visibilite()==SORTIE_VISIBILITE_TEAM_ALLIE) echo 'selected="selected"' ?>>Team + Alliés</option>
                <option value="<?php echo SORTIE_VISIBILITE_TOUS; ?>" <?php if($sortie->get_visibilite()==SORTIE_VISIBILITE_TOUS) echo 'selected="selected"' ?>>N'importe qui</option>
            </select></td>
    </tr>
    
        <tr>
            <td colspan="2"><input type="submit" disabled="disabled" value="modifier" /></td>
    </tr>
</table>
</form>

