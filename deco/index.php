<html lang="fr">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>jQuery UI Dialog - Default functionality</title>
  <link rel="stylesheet" href="//code.jquery.com/ui/1.12.0/themes/base/jquery-ui.css">
  <script src="https://code.jquery.com/jquery-1.12.4.js"></script>
  <script src="https://code.jquery.com/ui/1.12.0/jquery-ui.js"></script>
  <script>
$( ".dialog" ).dialog({
      autoOpen: false,
	  modal: true,
      show: {
        effect: "blind",
        duration: 1000
      },
      hide: {
        effect: "explode",
        duration: 1000
      }
    });
	
  </script>
  <style>
  div[role=dialog] { z-index: 1000 !important ;}
  .dialog{
	  display:none;
  }
  .ruban, .medaille,.badge306{
		cursor:pointer;

    filter:  brightness(0.7) saturate(34%);;
	-webkit-filter:  brightness(0.7) saturate(34%);;
-moz-filter:  brightness(0.7) saturate(34%);;
-o-filter:  brightness(0.7) saturate(34%);;
-ms-filter:  brightness(0.7) saturate(34%);;


	}
	.medaille{
		margin-left:-15px;
		    margin-top: -30px;
	}
	.badge306{
		position: absolute;
    top: 180px;
    left: 142px;
    width: 81px;
	cursor:default;
	opacity:0.4
	}
  </style>
  
</head>
<body bgcolor="black">

<div style="position:relative">
<div style="position:absolute;top: 259px;left: 359px;width:130px">
<?php
$nb = rand(0,18);
if(isset($_GET['m'])){
	$nb = (int) $_GET['m'];
}

for($i=1;$i<=min(18,$nb);$i++){
	
	?><img src="img/M<?php echo ($i%7+1)?>.png" width="35" title="medaille <?php echo $i?>" class="medaille" style="position:relative;z-index:<?php echo (500-$i)?>" onclick="$( '#dialog_M_<?php echo $i?>' ).dialog();"/><?php

}
if($i%6==0) echo '<br>';
?>

</div>
<div style="position:absolute;top: 181px;left: 341px;width:165px">
<?php
$nb2 = rand(0,24);
if(isset($_GET['nb'])){
	$nb2 = (int) $_GET['nb'];
}

for($i=1;$i<=min(24,$nb2);$i++){
	
	?><img src="img/R<?php echo ($i%15+1)?>.png" width="35" height="7" title="ruban <?php echo $i?>" class="ruban" onclick="$( '#dialog_<?php echo $i?>' ).dialog();"/><?php

}
?>

</div>

<?php
$badges = array('http://image.k-upload.com/view-img-norm_2016-06-22-10e8b40edemblemechass.png','http://image.k-upload.com/view-img-norm_2016-06-21-169cbf085emblemechass.png','http://www.starpirates.fr/images/306thplastic.png');
$badge_select = rand(0,count($badges)-1);
?>
<img src="<?php echo $badges[$badge_select]; ?>" class="badge306"/>
<img src="img/veste_officer.png" />
</div>
<?php
for($i=1;$i<=$nb2;$i++){
	
	?><div id="dialog_<?php echo $i?>" class="dialog" title="Basic dialog">
  <p><img src="img/R<?php echo ($i%15+1)?>.png" /> Ruban <?php echo $i?>, description du theatre d'opération...</p>
</div><?php
	
}
for($i=1;$i<=$nb;$i++){
	
	?><div id="dialog_M_<?php echo $i?>" class="dialog" title="Basic dialog">
  <p><img src="img/M<?php echo ($i%7+1)?>.png" width="80" style="float:left" /> Medaille <?php echo $i?>, décernée pour...</p>
</div><?php
	
}
?>