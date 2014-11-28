<?php
include_once 'template/menu.php';
$constructeurM = new ConstructeurManager($bdd);
$last_constructeur = $constructeurM->get_all_constructeur();
?>
<center>
    <form method="POST" action="upload_constructeur.php" enctype="multipart/form-data">
        <table class="tableform">
            <tr>
                <td colspan="2" align="center"><a href="http://fr.starcitizen.wikia.com/wiki/Cat%C3%A9gorie:Organisations" target="_blank" >lien d'aide</a></td>
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
    
    <div> Constructeurs ajoutés :</div>
<table class="table">
    <tr>
        <th>Nom</th>
        <th>Logo</th>
    </tr>
    <?php
    for($i=0; $i<count($last_constructeur);$i++){
        echo '<tr><td valign="middle">'.$last_constructeur[$i]->nom.'</td><td><img class="logoBig" src="upload/constructeur/'.$last_constructeur[$i]->logo.'"></td></tr>';
    }
    ?>
</table>
</center> 