<?php
if (!is_connected()){     header("Location: ?action=connexion&origine=".  urlencode($_SERVER["QUERY_STRING"]));     exit("veuillez vous (re)connectez"); }

$d = $_GET['date'];

$date = $jours[date("w",  strtotime(" +$d day"))].' '.date("d/m",  strtotime(" +$d day"));

$teamspeakM = new TeamspeakManager($bdd);
$teamspeak = $teamspeakM->get_all_teamspeak();

$vaisseau = $USER->get_vaisseau();


$type_vaisseauM = new VaisseauManager($bdd);
$type_vaisseau = $type_vaisseauM->get_all_vaisseau();
?>
<p>Ajouter une sortie</p>

<form action="upload_sortie.php" method="get">
<table>
    <tr>
        <td>Titre</td>
        <td><input type="text" required name="titre"/></td>
    </tr>
    <tr>
        <td>Detail</td>
        <td><textarea name="detail"></textarea></td>
    </tr>
    <tr>
        <td>Organisateur</td>
        <td><input type="text" readonly="readonly" value="<?php echo ($USER->get_team()?'['.$USER->get_team()->get_tag().']':'').' '.$USER->get_handle(); ?>" /></td>
    </tr>
    <tr>
        <td>Teamspeak</td>
        <td><select name="id_teamspeak">
                
            <?php
foreach ($teamspeak as $o) {

                 echo '<option value="'.$o->id_teamspeak.'">'.$o->label.'</option>';
             }
            ?>
            </select></td>
    </tr>
    <tr>
        <td>Date</td>
        <td><input  type="text" readonly="readonly" value="<?php echo $date; ?>" />
        <input type="hidden" name="date"  value="<?php echo date("Y-m-d",  strtotime(" +$d day")); ?>" /></td>
    </tr>
    <tr>
        <td>Début</td>
        <td><input name="debut" type="time"  value="21:00" /></td>
    </tr>
    <tr>
        <td>Fin</td>
        <td><input name="fin" type="time"  value="23:59" /></td>
    </tr>
    <tr>
        <td>Inscription possible par</td>
        <td><select name="visibilite">
                <?php
                if($USER->get_team()){
                    ?>
                           <option value="<?php echo SORTIE_VISIBILITE_TEAM; ?>">Team seulement</option>
                <option value="<?php echo SORTIE_VISIBILITE_TEAM_ALLIE; ?>">Team + Alliés</option>     
                <?php
                }
                ?>

                <option value="<?php echo SORTIE_VISIBILITE_TOUS; ?>">N'importe qui</option>
            </select></td>
    </tr>
    <tr>
        <td title="(0: aucune limite)">Max joueur </td>
        <td title="(0: aucune limite)"><input name="max_joueur" min="0" max="100" type="number"  value="8" class="numberTiny" /></td>
    </tr>
    <tr>
        <td valign="top">Contraintes <a href="javascript:add_contrainte()">Ajout</a></td>
        <td >
		<div id="contrainte"></diV>
		</td>
    </tr>
    <tr>
        <td colspan="2">Votre participation :</td>
        <td >

    </tr>	
    <tr>
            <td>Votre vaisseau :</td>
        <td><select name="id_jv">
                <?php
                foreach ($vaisseau as $o) {
                    
                    echo '<option value="'.$o->id_jv.'">'.$o->type.' ('.$o->nom.')</option>';
                }
                ?>
                </select></td>
        </tr>
        <tr>
            <td>Role</td>
                    <td>
               <select name="role">
                   <?php
                   for ($i=0; $i<count($roles); $i++){
                       echo '<option value="'.$i.'">'.$roles[$i].'</option>';
                   }
                   ?>
                  
                </select></td>
        </tr>
        <tr>
            <td colspan="2"><input type="submit" /></td>
    </tr>
</table>
</form>

<script>
var nb_contrainte=0;

function add_contrainte(){
	$('#contrainte').append('<p><input type="number" style="width:40px;" name="contrainte_number_ship['+nb_contrainte+']" value="0" min="0"> <select class="select" name="contrainte_type_ship['+nb_contrainte+']"><?php
	foreach($type_vaisseau as $v){
		echo '<option value="'.$v->id_vaisseau.'">'.$v->nom.'</option>';
	}
	
	?></select> dont <input type="number" style="width:40px;" name="contrainte_number_crew['+nb_contrainte+']" value="1" min="1"> equipage (pilote(s) inclus)</p>');
	nb_contrainte++;
	    $(".select").multiselect({
        multiple: false,
        selectedList: 2
    }).multiselectfilter({
        label:"Filre :",
        placeholder:"Entrer un texte"
    }); 
}
$(document).ready(function(){
	add_contrainte();
});
</script>

