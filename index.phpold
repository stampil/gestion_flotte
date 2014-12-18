<?php
require 'require/header.php';
require 'require/commun.php';

$action = isset($_GET["action"]) ? $_GET["action"] : "accueil";
?>
<!doctype html>
<html>
    <head>
        <title><?php echo $action; ?></title>
        <link rel="stylesheet" href="css/reset.css" />
        <link rel="stylesheet" href="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/themes/smoothness/jquery-ui.css" />
        <link rel="stylesheet" href="css/jquery_multiSelect.css" />
        <link rel="stylesheet" href="css/jquery.multiselect.filter.css" />
        <link rel="stylesheet" href="css/commun.css" />
        <link rel="stylesheet" href="css/<?php echo $action?>.css" />
    </head>

    <body>
        <script src="//ajax.googleapis.com/ajax/libs/jquery/2.1.1/jquery.min.js"></script>
        <script src="//ajax.googleapis.com/ajax/libs/jqueryui/1.11.2/jquery-ui.min.js"></script>
        <script src="js/jquery_multiSelect.js"></script>
        <script src="js/jquery.multiselect.filter.js"></script>
        <?php
        include_once 'vue/' . $action . '.php';
        ?>
        <script src="js/commun.js"></script>
        <script src="js/<?php echo $action?>.js"></script>
    </body>

</html>