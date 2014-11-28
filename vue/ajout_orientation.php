<?php
include_once 'template/menu.php';
$orientationM = new OrientationManager($bdd);
$orientation = $orientationM->get_all_orientation();
?>
<center>
    <form method="POST" action="upload_orientation.php" enctype="multipart/form-data">
        <table class="tableform">
            <tr>
                <td colspan="2" align="center"><a href="https://robertsspaceindustries.com/community/orgs/listing?openPanel=1" target="_blank" >lien officiel</a></td>
            </tr>
            <tr>
                <td>Nom :</td>
                <td><input type="text" name="nom" required></td>      
            </tr>
            <tr>
                <td>Logo :</td>
                <td><input type="file"  name="logo" id="logo" required></td>      
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" value="ok"></td>      
            </tr>
        </table>

    </form>


<div> orientations ajoutées :</div>
<table class="table">
    <tr>
        <th>Nom</th>
        <th>Logo</th>
    </tr>
    <?php
    for($i=0; $i<count($orientation);$i++){
        echo '<tr><td valign="middle">'.$orientation[$i]->nom.'</td><td><img class="logo_medium" src="upload/orientation/'.$orientation[$i]->logo.'"></td></tr>';
    }
    ?>
</table>

</center> 