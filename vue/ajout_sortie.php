<?php
if(!is_connected()) exit("veuillez vous (re)connectez");

$d = $_GET['date'];

$date = $jours[date("w",  strtotime(" +$d day"))].' '.date("d/m",  strtotime(" +$d day"));

$teamspeakM = new TeamspeakManager($bdd);
$teamspeak = $teamspeakM->get_teamspeak();

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
        <td><input type="text" readonly="readonly" value="[<?php echo $USER->get_team()[0]->tag."] ".
                $USER->get_handle(); ?>" /></td>
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
            <td colspan="2"><input type="submit" /></td>
    </tr>
</table>
</form>

