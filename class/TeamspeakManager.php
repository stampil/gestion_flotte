<?php

class TeamspeakManager {
    private $bdd;
    
    public function __construct(MyPDO $bdd = null) {
        if($bdd){
            $this->bdd = $bdd;
        }
        else{
            $this->bdd = new MyPDO();
        }
    }
    
   
    
    public function get_teamspeak(){
        $query="SELECT id_teamspeak, url, label
                FROM ".MyPDO::DB_FLAG."teamspeak"; 
        $ret = $this->bdd->query($query);
        return $ret[0];
    }
    
    
}
