<?php
include_once 'template/menu.php';
$vaisseauM = new VaisseauManager($bdd);
$last_vaisseau = $vaisseauM->get_all_vaisseau();
$constructeurM = new ConstructeurManager($bdd);
$list_constructeur = $constructeurM->get_all_constructeur();
?>
<center>
    <form method="POST" action="upload_vaisseau.php" enctype="multipart/form-data">
        
        <table class="tableform">
            <tr>
                <td colspan="2" align="center"><a href="https://robertsspaceindustries.com/ship-specs" target="_blank">Lien officiel</a></td>
            </tr>
            <tr>
                <td>Nom :</td>
                <td><input type="text" name="nom" required></td>      
            </tr>
            <tr>
                <td>Constructeur :</td>
                <td>
                    
                    <select name="id_constructeur" id="id_constructeur" class="select">
                    <?php
                    foreach($list_constructeur as $c){
                        echo '<option value="'.$c->id_constructeur.'">'.$c->nom.'</option>';
                    }
                    ?>
                    </select></td>      
            </tr>
            <tr>
                <td>Image :</td>
                <td><input type="file"  name="img" id="avatar" required></td>      
            </tr>
            <tr>
                <td>Focus :</td>
                <td><input type="text" name="focus" required placeholder="ex: Exploration"></td>      
            </tr>
            <tr>
                <td>Nb equipage :</td>
                <td><input type="number" name="nbEquipage" value="1" min="1"></td>      
            </tr> 
            <tr>
                <td>Cargo :</td>
                <td><input type="number" name="cargo"></td>      
            </tr>
            <tr>
                <td>Autonomie :</td>
                <td><input type="number" name="autonomie" placeholder="a remplir une fois connu"></td>      
            </tr>
            <tr>
                <td>Cout réparation :</td>
                <td><input type="number" name="coutReparation" placeholder="a remplir une fois connu"></td>      
            </tr>
          
            <tr>
                <td colspan="2" align="center"><input type="submit" value="ok"></td>      
            </tr>
        </table>

    </form>
    
    <div> Vaisseaus ajoutés :</div>
<table class="table">
    <tr>
        <th>Nom</th>
        <th>Constructeur</th>
        <th>Image</th>
        <th>Focus</th>
        <th>Cargo</th>
        <th>Nb equipage</th>
    </tr>
    <?php
    for($i=0; $i<count($last_vaisseau);$i++){
        $constructeur = $constructeurM->get_constructeur($last_vaisseau[$i]->id_constructeur);
        echo '<tr>'
        . '<td valign="middle">'.$last_vaisseau[$i]->nom.'</td>'
        . '<td valign="middle">'.$constructeur[0]->nom.'</td>'
        . '<td><img class="logoBig" src="upload/vaisseau/'.$last_vaisseau[$i]->img.'"></td>'
        . '<td valign="middle">'.$last_vaisseau[$i]->focus.'</td>'
        . '<td valign="middle">'.$last_vaisseau[$i]->cargo.'</td>'
        . '<td valign="middle">'.$last_vaisseau[$i]->nbEquipage.'</td>'
        . '</tr>';
    }
    ?>
    <tr>
    </tr>
</table>
</center> 