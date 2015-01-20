


<?php
if(is_connected()){

?>
<center>
    <form method="POST" action="?action=connexion">
        <input type="hidden" name="deco" value="1" />
        <table class="tableform">
            <tr>
                <td>Bienvenue <?php echo  $USER->get_handle() ?></td>  
            </tr>
            <tr>
                <td><a href="https://robertsspaceindustries.com/citizens/<?php echo  $USER->get_handle() ?>" target="_blank"><img src="http://vps36292.ovh.net/mordu/t/<?php  echo$USER->get_team()->get_tag() ?>/<?php echo  $USER->get_handle() ?>.png" /></a></td>
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" value="se deco"></td>      
            </tr>
        </table>

    </form>
</center> 

<?php
}
else{
?>
<center>
    <form method="POST" action="?action=connexion">

        <table class="tableform">
            <tr>
                <td>Email :</td>
                <td><input type="email" name="email" required></td>      
            </tr>
            <tr>
                <td>Mot de passe :</td>
                <td><input type="password" name="mdp" required></td>      
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" value="ok"></td>      
            </tr>
        </table>

    </form>
</center> 

<?php } ?>