<?php
include_once 'template/menu.php';
if (!is_connected()){     header("Location: ?action=connexion&origine=".  urlencode($_SERVER["QUERY_STRING"]));     exit("veuillez vous (re)connectez"); }
$teamM = new TeamManager($bdd);
$allianceM = new AllianceManager($bdd);
$joueurM = new JoueurManager($bdd);
$teams =$joueurM->get_team($USER->get_id());
if(isset($_POST["select_teamA"])){
    
    $allianceM->set_alliance_team($_POST["select_teamA"], $_POST["select_teamB"], $_POST["select_alliance"]);
   
}

$team = $teamM->get_all_team();
$allied = $allianceM->get_all_alliance_team($teams->get_id());
$alliance = $allianceM->get_all_alliance();

?>
<center>
    <form method="POST" action="?action=ajout_alliance_team" enctype="multipart/form-data">
        <table class="tableform">
            <tr>
                <td>Team :</td>
                <td>
                <select id="select_teamA" name="select_teamA" class="select">
                        <?php
                            echo '<option value="'.$teams->get_id().'">' . $teams->get_nom() . '</option>';
                        ?>
                   </select>
                </td>      
            </tr>
            <tr>
                <td>Alliance :</td>
                <td>
                <select id="select_alliance" name="select_alliance" class="select">
                        <?php
                        for ($i = 0; $i < count($alliance); $i++) {                            
                            echo '<option value="'.$alliance[$i]->id_alliance.'">' . $alliance[$i]->nom . '</option>';
                        }
                        ?>
                   </select>
                </td>      
            </tr>
            <tr>
                <td>Team :</td>
                <td>
                <select id="select_teamB_joueur" name="select_teamB" class="select">
                        <?php
                        for ($i = 0; $i < count($team); $i++) {
                            if($teams->get_id() == $team[$i]->id_team) continue;
                            echo '<option value="'.$team[$i]->id_team.'">' . $team[$i]->nom . '</option>';
                        }
                        ?>
                   </select></td>      
            </tr>
            
            <tr>
                <td colspan="2" align="center"><input type="submit" value="ok"></td>      
            </tr>
        </table>

    </form>
    
    <div> Teams ajoutés :</div>
<table class="table">
    <tr>
        <th>Nom</th>
        <th>Alliance</th>
        <th>Nom</th>
        <?php
        foreach($allied as $o){
            echo '<tr><td><a href="'.$o->urlA.'" target="_blank"><img src="upload/team/'.$o->logoA.'" title="'.$o->nomA.'" /></a></td>';
            echo '<td>'.$o->alliance.'</td>';
            echo '<td><a href="'.$o->urlB.'" target="_blank"><img src="upload/team/'.$o->logoB.'" title="'.$o->nomB.'" /></a></td>'        
            . '</tr>';
        }
        ?>
    </tr>
   
</table>
</center> 