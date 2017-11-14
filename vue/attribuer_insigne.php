<?php

$decoM = new DecorationManager($bdd);
$info_insigne = $decoM->get_all_insigne();
$joueurM = new JoueurManager($bdd);
$info_joueur = $joueurM->get_all_joueur();
if(!empty($_GET['msg'])) echo $_GET['msg'];
?>
<center>
    <form method="POST" action="attribue_insigne.php" enctype="multipart/form-data">
        <table class="tableform">
             
            <tr>
                <td>Pilote :</td>
                <td><select name="id_joueur[]" id="id_joueur" class="multiselect" multiple="multiple" >
                    <?php
                    foreach($info_joueur as $c){
                        echo '<option value="'.$c->id_joueur.'">'.$c->handle.($c->tag?' ('.$c->tag.')':'').'</option>';
                    }
                    ?>
                    </select></td>      
            </tr>
            <tr>
                <td>insigne :</td>
                <td><select name="id_insigne[]" id="id_insigne" class="multiselect" multiple="multiple" >
                    <?php
                    foreach($info_insigne as $c){
                        echo '<option value="'.$c->id.'">'.$c->nom.'</option>';
                    }
                    ?>
                    </select></td>      
            </tr>
			<tr>
                <td>Phase du jeu :</td>
                <td><select name="id_groupe[]" id="id_groupe" class="multiselect" multiple="multiple">
                    <option value="0">Alpha</option>
					<option value="1">Beta</option>
					<option value="2">Release</option>
                    </select></td>      
            </tr>
            

                        <tr>
                <td colspan="2" align="center"><input type="submit" value="ok"></td>      
            </tr>
        </table>

    </form>

    
</center> 