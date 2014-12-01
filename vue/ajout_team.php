<?php
include_once 'template/menu.php';
$teamM = new TeamManager($bdd);
$last_team = $teamM->get_all_team();
$orientationM = new OrientationManager($bdd);
$orientation = $orientationM->get_all_orientation();
?>
<center>
    <form method="POST" action="upload_team.php" enctype="multipart/form-data">
        <table class="tableform">
            <tr>
                <td colspan="2" align="center"> Ajout Team :<a href=https://robertsspaceindustries.com/community/orgs/listing?openPanel=1" target="_blank" >lien d'aide</a></td>
            </tr>
            <tr>
                <td>Nom :</td>
                <td><input type="text" name="nom" required></td>      
            </tr>
            <tr>
                <td>Tag :</td>
                <td><input type="text" name="tag" required></td>      
            </tr>
            <tr>
                <td>Logo :</td>
                <td><input type="file"  name="logo" id="logo" required></td>      
            </tr>
            <tr>
                <td>Url :</td>
                <td><input type="url"  name="url" value="http://" required></td>      
            </tr>
            <tr>
                <td>Orientation:</td>
                <td>
                   <select id="select_orientation_team" name="select_orientation_team[]" multiple="multiple" class="multiselect">
                        <?php
                        for ($i = 0; $i < count($orientation); $i++) {
                            echo '<option value="'.$orientation[$i]->id_orientation.'">' . $orientation[$i]->nom . '</option>';
                        }
                        ?>
                   </select>
                    <div>    
                </td>
            </tr>
            <tr>
                <td>Nb membre :</td>
                <td><input type="number" name="nbJoueur" value="1" min="1"></td>      
            </tr> 
            <tr>
                <td colspan="2" align="center"><input type="submit" value="ok"></td>      
            </tr>
        </table>

    </form>
    
    <div> Teams ajoutés :</div>
    
    <?php
    for($i=0; $i<count($last_team);$i++){
        echo '<a href="'.$last_team[$i]->url.'" target="_blank"><img class="logoBig" src="upload/team/'.$last_team[$i]->logo.'" title="'.$last_team[$i]->nom.'"></a> ';
    }
    ?>
    
</center> 