<?php
include_once 'template/menu.php';
if (!is_connected()){     header("Location: ?action=connexion");     exit("veuillez vous (re)connectez"); }
$allianceM = new AllianceManager($bdd);
$teamM = new TeamManager($bdd);

if(isset($_POST["nom"])){
    
    $alliance = new Alliance((object) array(
            "id_alliance" =>null,
            "nom" => $_POST["nom"],
            "charte" => $_POST["charte"]
        ));

    $allianceM->set_alliance($alliance);
    
}

$alliance = $allianceM->get_all_alliance();
$team = $teamM->get_all_team();
?>
<center>
    <form method="POST" action="?action=ajout_alliance" enctype="multipart/form-data">
        <table class="tableform">
            <tr>
                <td colspan="2">/!\ Alliance entre plusieurs team, ne peut pas etre relié a un joueur<br />ce type d'alliance n'influe que les 2 teams raccordé, par exemple un cessé le feu</td>     
            </tr>
            <tr>
                <td>Nom :</td>
                <td><input type="text" name="nom" required></td>      
            </tr>

            <tr>
                <td>Charte :</td>
                <td><textarea name="charte" required></textarea></td>      
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" value="ok"></td>      
            </tr>
        </table>

    </form>
    
    <div> Alliances ajoutés :</div>
<table class="table">
    <tr>
        <th>Nom</th>
        <th>Charte</th>
    </tr>
    <?php
    for($i=0; $i<count($alliance);$i++){
        echo '<tr><td valign="middle">'.$alliance[$i]->nom.'</td>';
        echo '<td><div>'.$alliance[$i]->charte.'</div></td></tr>';
    }
    ?>
</table>
</center> 