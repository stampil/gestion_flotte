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
                <td><a href="https://robertsspaceindustries.com/citizens/<?php echo  $USER->get_handle() ?>" target="_blank"><?php if($USER->get_team()){ ?><img src="http://vps36292.ovh.net/mordu/t/<?php  echo $USER->get_team()->get_tag() ?>/<?php echo  $USER->get_handle() ?>.png" /><?php } ?></a></td>
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
                <td><input type="email" name="email" id="email" value="<?php echo @$_POST["email"] ?>" required></td>      
            </tr>
            <tr>
                <td>Mot de passe :</td>
                <td><input type="password" name="mdp" required></td>      
            </tr>
            <tr>
                <td colspan="2" align="center"><input type="submit" value="ok"></td>      
            </tr>
        </table>
        <div id="mdp_oublie">Mot de passe oublié?</div>

    </form>
    <p>Des problemes de connection? <br />
    <a href="http://vps36292.ovh.net/mordu/robertsspaceindustriesfr/" target="_blank">consulter ce site ici.</a>
</center> 
<div id="dialog" title="récupération du mot de passe">
    <form method="post" action="mdp_oublie.php">
  <p>Veuillez entrer votre email et un nouveau mot de passe généré vous sera envoyé</p>
  <input type="email" name="email_oublie_mdp"  value="<?php echo @$_POST["email"] ?>" id="email_oublie_mdp" required>
  <input type="submit" value="envoyer" />
    </form>
</div>

<?php } ?>