<?php
if (!is_connected()){     header("Location: ?action=connexion&origine=".  urlencode($_SERVER["QUERY_STRING"]));     exit("veuillez vous (re)connectez"); }
$decoM = new DecorationManager($bdd);
$info_ruban = $decoM->get_all_ruban();

?>
<center>
    <form method="POST" action="upload_ruban.php" enctype="multipart/form-data">
        <table class="tableform">
             
            <tr>
                <td>Nom :</td>
                <td><input type="text" name="nom" id="nom" required> </td>      
            </tr>
            <tr>
                <td>Description :</td>
                <td><textarea name="description" required></textarea></td>      
            </tr>
            
            <tr>
                <td>Img :</td>
                <td><input type="file"  name="img" required></td>      
            </tr>
            <tr>
                <td>Remplace :</td>
                <td>
                    <select class="select" name="remplace">
                        <option value="0">rien</option>
                            <?php
    for($i=0; $i<count($info_ruban);$i++){
        echo '<option value="'.$info_ruban[$i]->id.'">'.$info_ruban[$i]->nom.'</option>';
    }
    ?>
                    </select>
                
                </td>      
            </tr>
                        <tr>
                <td colspan="2" align="center"><input type="submit" value="ok"></td>      
            </tr>
        </table>

    </form>

    <div> <?php echo count($info_ruban); ?> ruban ajoutés :</div>
    
    <?php
    
    for($i=0; $i<count($info_ruban);$i++){
        echo ' '.$info_ruban[$i]->nom.' <img src="upload/ruban/'.$info_ruban[$i]->img.'"  width="50" title="'.str_replace('"','',$info_ruban[$i]->description).'"/> - ';
    }
    ?>
</center> 