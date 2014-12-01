<?php

class MyPDO extends PDO{

    const DB_FLAG='rsi_';



	public static $cache = array();
	public static $cache_activate = true;
	public static $nb_cache = 0;
	
	public function __construct($options=null){
            
            $DB_HOST= 'localhost';
            $DB_PORT='3306';
            $DB_NAME='starcitizen';
            $DB_USER='root';
            $DB_PASS='';
            
            $path = 'mysql:host='.$DB_HOST.';port='.$DB_PORT.';dbname='.$DB_NAME;
           
		parent::__construct($path,
                         $DB_USER, $DB_PASS, $options);
		$this->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_OBJ);
		$this->query("SET NAMES 'utf8'");

	}

	public function query($query){ //secured query with prepare and execute
		$timestart=microtime(true);
		$args = func_get_args();
		array_shift($args); //first element is not an argument but the query itself, should removed
		if(is_array(@$args[0])){
		$args = $args[0];
		}
		
		if(MyPDO::$cache_activate && isset(MyPDO::$cache[$query."::".serialize($args)])){
			//echo "<div class='query'>cache : '$query' <div>";
			MyPDO::$nb_cache++;		
			return MyPDO::$cache[$query."::".serialize($args)];
		}
		
		MyPDO::$cache_activate = true;

		$reponse = parent::prepare($query);
		$reponse->execute($args);
		$err = $reponse->errorInfo();
		if(@$err[2] ){
                    if(preg_match("/Duplicate entry/",$err[2])) return -1;
                    echo $err[2].'<hr />'.$query.'<hr />';
                    print_r($args);
                    return -1;
		}
		
		$ret = array();
		while ($o = $reponse->fetch()){
			array_push($ret, $o);		
		}
		$reponse->closeCursor();
		if(count($ret)) MyPDO::$cache[$query."::".serialize($args)]=$ret; // on cache que les requete qui retourne des resultat, insert update doit tjrs etre executé
		$timeend=microtime(true);
		$time=$timeend-$timestart;
		$page_load_time = number_format($time, 3);
		//echo '<div class="query">query: '.$query.' ('.$page_load_time.'sec)</div>';
		return $ret;

	}

	public function insecureQuery($query){ //you can use the old query at your risk ;) and should use secure quote() function with it
		return parent::query($query);
	}

}
?>