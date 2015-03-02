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
        $USER=new Joueur($joueur);
        $_SESSION["sjoueur"]= serialize($USER); 
        if(isset($_POST["origine"])){
            echo "<script>location.href='?".$_POST["origine"]."';</script>";
        }
    }
    else{
        echo "<p>mdp invalide</p>";
    }
}
                    include_once 'template/menu.php';
                ?>
        </div>
        
        <video class="vid" id="vid1" width="100%"  autoplay="autoplay">
        <source src="video/auzgk  action essentials 2 - smoke atmosphere 4 HD.mp4" type="video/mp4" />
    </video>
        <video class="vid" id="vid2" width="100%" autoplay="autoplay" loop>
        <source src="video/fog effect.mp4" type="video/mp4" />
    </video>
        <video class="vid" id="vid3" width="100%" autoplay="autoplay">
        <source src="video/auzgk  action essentials 2 - falling  sparks HD.mp4" type="video/mp4" />
    </video>
        
        
        
    <div class="content">
        <?php
        include_once 'vue/' . $action . '.php';
        ?>
    
   
    </div>
    <script>
        var ajustVideo = function(){
            $('.vid').attr('width',1.25*$(window).outerWidth());
        };
        
        $(function() {
            //ajustVideo();
            $( window ).resize(function(){
                ajustVideo();
                console.log('resize',1.25*$(window).outerWidth());
            });
            

            $( "#vid1, #vid3" ).animate({
                opacity: 0.5
              }, 4000);
              
            $( "#vid2" ).animate({
                opacity: 0.9
              }, 10000, function(){
                  $( "#vid2" ).animate({
                opacity: 0.2
              }, 60000);
              });
              
               $("#vid1, #vid3").bind('ended', function(){
                   $(this).css('opacity',0);
               });
  
        });
    </script>
             <script src="js/commun.js"></script>
        <script src="js/<?php echo $action?>.js"></script>
</body>
</html>