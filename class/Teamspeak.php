<?php

class Teamspeak {

    private $id;
    private $label;
    private $url;




    public function __construct($o = null) {
        if ($o) {
            $this->set_id($o->id_teamspeak);
            $this->set_label($o->label);
            $this->set_url($o->url);
        }
    }
    
    public function get_id(){
        return $this->id;
    }
    
    public function set_id($id){
        $this->id = $id;
    }
    
    public function get_label(){
        return $this->id_label;
    }
    
    public function set_label($label){
        $this->label = $label;
    }
    
    public function get_url(){
        return $this->url;
    }
    
    public function set_url($url){       
        $this->url = $url;
    }
 
}