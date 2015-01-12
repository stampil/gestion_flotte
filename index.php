<?php
require 'require/header.php';
require 'require/commun.php';

$action = isset($_GET["action"]) ? $_GET["action"] : "accueil";
?>
<!DOCTYPE html>
<html>
<head>

    <title><?php echo $action; ?></title>
    <link href="css/styles.css" rel="stylesheet" type="text/css">
    <link rel="stylesheet" href="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css">
    <link rel="stylesheet" href="css/jquery_multiSelect.css" />
    <link rel="stylesheet" href="css/jquery.multiselect.filter.css" />
    <link rel="stylesheet" href="css/commun.css" />
    <link rel="stylesheet" href="css/kitgraph.css" />
    <link rel="stylesheet" href="http://fonts.googleapis.com/css?family=Fira%20Mono:400,700" />
    <link rel="stylesheet" href="css/<?php echo $action?>.css" />
</head>
<body>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="http://ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
        <script src="js/jquery_multiSelect.js"></script>
        <script src="js/jquery.multiselect.filter.js"></script>
        
        
        <div id="menu">
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
        </div>
    <video id="vid" width="1920"  autoplay="autoplay">
        <source src="video/Imagine Star Citizen.mp4" type="video/mp4" />
    </video>
    <div class="content">
        <?php
        include_once 'vue/' . $action . '.php';
        ?>
    
   
    </div>
    <script>
        var ajustVideo = function(){
            $('#vid').attr('width',$(window).outerWidth());
        };
        
        $(function() {
            ajustVideo();
            $( window ).resize(function(){
                ajustVideo();
                console.log('resize',$(window).outerWidth());
            });
        });
    </script>
</body>
</html>