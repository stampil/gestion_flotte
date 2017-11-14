<?php
if (!is_connected()){     header("Location: ?action=connexion&origine=".  urlencode($_SERVER["QUERY_STRING"]));     exit("veuillez vous (re)connectez"); }
$decoM = new DecorationManager($bdd);
$info_insigne = $decoM->get_all_insigne();

?>
<center>
    <form method="POST" action="upload_insigne.php" enctype="multipart/form-data">
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
    for($i=0; $i<count($info_insigne);$i++){
        echo '<option value="'.$info_insigne[$i]->id.'">'.$info_insigne[$i]->nom.'</option>';
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

    <div> <?php echo count($info_insigne); ?> insigne ajoutés :</div>
    
    <?php
    
    for($i=0; $i<count($info_insigne);$i++){
        echo ' '.$info_insigne[$i]->nom.' <img src="upload/insigne/'.$info_insigne[$i]->img.'"  width="50" title="'.str_replace('"','',$info_insigne[$i]->description).'"/> - ';
    }
    ?>
</center> 