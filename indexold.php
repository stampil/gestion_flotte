<?php
require 'require/header.php';
require 'require/commun.php';

$action = isset($_GET["action"]) ? $_GET["action"] : "accueil";
?>
<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.0 Transitional//EN"
    <html>
<head>
    <!-- Design par Jean-Fran�ois Pariseau - techgrafik - dji - pour kitgrafik.com -->
    <title><?php echo $action; ?></title>
    <meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
    <link href="css/styles.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
    <link rel="stylesheet" href="css/jquery_multiSelect.css" />
    <link rel="stylesheet" href="css/jquery.multiselect.filter.css" />
    <link rel="stylesheet" href="css/commun.css" />
    <link rel="stylesheet" href="css/<?php echo $action ?>.css" />
</head>
<body>
    <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
        <script src="js/jquery_multiSelect.js"></script>
        <script src="js/jquery.multiselect.filter.js"></script>
        
        
    <table width="100%" height="100%"  border="0" cellpadding="0" cellspacing="0">
        <tr>
            <td>&nbsp;</td>
            <td width="781" height="49"><a name="haut"></a><img src="images/header1.jpg" width="781" height="49"></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td width="781" height="72"><img src="images/header2.jpg" width="781" height="72"></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td></td>
            <td width="781" height="27" background="images/menuBG.jpg">
                <?php
                if(@$_POST["deco"]){
    
    session_destroy();
}

if(@$_POST["email"]){
    $email = $_POST["email"];
    $mdp = $crypt->crypte($_POST["mdp"]);
    
    $joueurM = new JoueurManager();
    $joueur = $joueurM->identifie_joueur($email, $mdp);
    if($joueur){
        $USER=new Joueur($joueur[0]);
        $_SESSION["sjoueur"]= serialize($USER);     
    }
    else{
        echo "<p>mdp invalide</p>";
    }
}
                    include_once 'template/menu.php';
                ?>
            </td>
            <td></td>
        </tr>
        <tr>
            <td></td>
            <td width="781" height="27"><img src="images/headerTexte.gif" width="781" height="27"></td>
            <td>&nbsp;</td>
        </tr>
        <tr>
            <td>&nbsp;</td>
            <td width="781" valign="top" background="images/BgTexte.gif"><table width="781"  border="0" cellspacing="0" cellpadding="0">
                    <tr>
                        <td width="100">&nbsp;</td>
                        
                        <td width="581" valign="top">
                            <table width="404" border="0" cellpadding="0" cellspacing="0" class="tiret">
                                <tr>
                                    <td><span class="titre"><?php echo strtoupper($action);?></span></td>
                                </tr>
                            </table>
                            <br>
                            <?php
        include_once 'vue/' . $action . '.php';
        ?>
                            <table width="404" height="25" border="0" cellpadding="0" cellspacing="0" class="tiret">
                                <tr>
                                    <td><div align="right"><a href="#haut"><img src="images/hautDePage.gif" alt="Haut de page" width="100" height="17" border="0"><br>
                                                <br>
                                                <br>
                                            </a></div></td>
                                </tr>
                            </table>
                            <br>
                            <div align="right"><span class="texteKitgrafik">Design par <a href="http://www.techgrafik.com/" target="_blank">DJI</a> pour <a href="http://www.kitgrafik.com/graphistes/index-g-25.html" target="_blank">Kitgrafik.com</a></span> </div>
                            <p class="texte"></p></td>
                        <td width="100">&nbsp;</td>
                    </tr>
                </table>
                <div align="center"></div></td>
            <td>&nbsp;</td>
        </tr>
    </table>
        
         <script src="js/commun.js"></script>
        <script src="js/<?php echo $action?>.js"></script>
</body>
</html>