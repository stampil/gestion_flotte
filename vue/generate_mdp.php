
<?php
$test = $crypt->crypte($_GET["email"]."toutestok".date("Ymd"));

if($test !=$_GET["auth"]){
    exit("Ce lien n'est pas ou plus valide");
}
else{
?>
<form method="POST" action="change_mdp.php" name="form" id="form">
    <input type="hidden" name="email" value="<?php echo $_GET["email"]; ?>" />
    <input type="hidden" name="auth" value="<?php echo $_GET["auth"]; ?>" />
    <table>
        <tr>
            <td>
                votre nouveau mot de passe
            </td>
            <td>
                <input type="password" name="mdp" id="mdp" />
            </td>
        </tr>
        <tr>
            <td>
                répétez pour verif
            </td>
            <td>
                <input type="password" name="mdp2" id="mdp2" />
            </td>
        </tr>
                <tr>
            <td colspan="2">
                <input type="submit" value="enregistrer ce nouveau mot de passe" />
            </td>
        </tr>
    </table>
</form>


<?php } ?>
