<?php
include_once 'template/menu.php';
if (!is_connected()){     header("Location: ?action=connexion&origine=".  urlencode($_SERVER["QUERY_STRING"]));     exit("veuillez vous (re)connectez"); }
$allianceM = new AllianceGroupeManager($bdd);
$alliance_groupe = $allianceM->get_all_allianceGroupe();
$teamM = new TeamManager($bdd);
$team = $teamM->get_all_team();
?>
<center>
    <form method="POST" action="upload_groupe_alliance.php" enctype="multipart/form-data">
        <table class="tableform">
            <tr>
                <td colspan="2">/!\ Alliance privée entre plusieurs team, ne peut pas etre relié a un joueur<br />toutes les teams qui ont cette alliances en commune sont relié par cette accord, par exemple un accord commercial précis, et controle cette alliance et peuvent refusé l'entrée d'une team dans cette alliance.</td>     
            </tr>
            <tr>
                <td>Nom :</td>
                <td><input type="text" name="nom" required></td>      
            </tr>

            <tr>
                <td>Charte :</td>
                <td><textarea name="description" required></textarea></td>      
            </tr>
            <tr>
                <td>Logo :</td>
                <td><input type="file"  name="logo" id="logo"></td>      
            </tr>           
            <tr>
                <td>Url :</td>
                <td><input type="url"  name="url" value=""></td>      
            </tr>
            <tr>
                <td>Teams concernées:</td>
                <td>
                   <select id="select_teamS_joueur" name="select_teamS_joueur[]" multiple="multiple" class="multiselect">
                        <?php
                        for ($i = 0; $i < count($team); $i++) {
                            echo '<option value="'.$team[$i]->id_team.'">' . $team[$i]->nom . '</option>';
                        }
                        ?>
                   </select>
                    <div>    
                </td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" value="ok"></td>      
            </tr>
        </table>

    </form>
    
    <div> Groupe d'alliances ajoutés :</div>
<table class="table">
    <tr>
        <th>Nom</th>
        <th>Logo</th>
        <th>Charte</th>
        <th>Membres</th>
    </tr>
    <?php
    for($i=0; $i<count($alliance_groupe);$i++){
        
        $get_allied = $allianceM->get_allied($alliance_groupe[$i]->id_alliance);
        echo '<tr>'
        . '<td valign="middle"><a href="'.($alliance_groupe[$i]->url?$alliance_groupe[$i]->url:'#').'" target="_blank">'.$alliance_groupe[$i]->nom.'</a></td>';
            if($alliance_groupe[$i]->logo)   echo '<td><img class="logoMedium" src="upload/groupeAlliance/'.$alliance_groupe[$i]->logo.'"></td>';
            else echo '<td></td>';
            echo     '<td><div class="displayLimited">'.$alliance_groupe[$i]->description.'</div></td>';
            echo '<td>';
            foreach($get_allied as $o){
                echo '<img src="upload/team/'.$o->logo.'" class="logoMini" title="'.$o->nom.'" />';
            }
            echo '</td>';
             echo '</tr>';
    }
    ?>
</table>
</center> 