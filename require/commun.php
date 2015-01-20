<?php

date_default_timezone_set('Europe/Paris');

spl_autoload_register(function($class) {
    include 'class/' . $class . '.php';
});

define("SORTIE_VISIBILITE_TEAM",1);
define("SORTIE_VISIBILITE_TEAM_ALLIE",2);
define("SORTIE_VISIBILITE_TOUS",3);

$bdd = new MyPDO();
$crypt = new Crypt();

function upload_img($name, $dest) {
    $target_dir = "upload/$dest/"; 
    $uploadErr = "";
    $imageFileType = strtolower(pathinfo(basename($_FILES[$name]["name"]), PATHINFO_EXTENSION));
    $uniq_img =uniqid("img_", true).".".$imageFileType;
    $target_file = $target_dir . $uniq_img;

    if (isset($_POST["submit"])) {
        $check = getimagesize($_FILES[$name]["tmp_name"]);
        if (!$check) {
            $uploadErr.= "<p>File is not an image.</p>";
        }
    }
    if (file_exists($target_file)) {
        $uploadErr.= "<p>Sorry, file " . basename($_FILES[$name]["name"]) . " already exists. <img src='$target_file' /></p>";
    }
    if ($_FILES[$name]["size"] > 3 * 1024 * 1024) {
        $uploadErr.= "<p>Sorry, your file is too large.</p>";
    }
    if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
        $uploadErr.= "<p>Sorry, only JPG, JPEG, PNG & GIF files are allowed. ($imageFileType)</p>";
    }
    if (!$uploadErr) {
        if (!move_uploaded_file($_FILES[$name]["tmp_name"], $target_file)) {
            $uploadErr.= "<p>Sorry, there was an error uploading your file.</p>";
        }
    }
    
    return array($uploadErr,$uniq_img);
}

$USER = null;
if(isset($_SESSION["sjoueur"]) && $_SESSION["sjoueur"]){
    $USER = unserialize($_SESSION["sjoueur"]);
}

function is_connected($check_droit=null){
    global $USER;
    if($check_droit=="ADMIN" && $USER && $USER->get_admin()){
        return true;
    }
    else if($check_droit=="ADMIN" && $USER && !$USER->get_admin()){
        return false;
    }

    if($USER && $USER->get_id()  && !@$_POST["deco"]) return true;
    return false;
}

 /**
  * 
  * @param type $path api/arena-commander/getLeaderboard
  * @param type $data {"mode":"BR","team":"PERSEIDE"}
  * @return object
  */
function API($path, $data){
    $url = 'https://robertsspaceindustries.com/api/'.$path;

    $options = array(
                    'http' => array(
                                    'header' => "application/x-www-form-urlencoded\r\n",
                                    'method' => 'POST',
                                    'content' => http_build_query(json_decode($data)),
                    ),
    );
    $context = @stream_context_create($options);
    $result = @file_get_contents($url, false, $context);
    $result = json_decode($result);
    return $result;
}

$jours = array("DIM","LUN","MAR","MER","JEU","VEN","SAM");

function usdatetotime($usdate){
    return preg_replace("/[0-9]{4}-[0-9]{2}-[0-9]{2} ([0-9]{2}):([0-9]{2}):[0-9]{2}/", "$1h$2", $usdate);
}

?>