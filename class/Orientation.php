<?php
class Orientation {
    private $nom;
    private $logo;
    
    public function __construct($o=null) {
        if($o){
            $this->set_nom($o->nom);
            $this->set_logo($o->logo);
        }
    }
    
    public function get_nom(){
        return $this->nom;
    }
    public function set_nom($nom){
        $this->nom = $nom;
    }
        
    public function get_logo(){
        return $this->logo;
    }
    public function set_logo($logo){
        $this->logo = $logo;
    }
}
?>