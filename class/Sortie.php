<?php

class Sortie {

    private $id;
    private $id_organisateur;
    private $titre;
    private $detail;
    private $debut;
    private $fin;


    public function __construct($o = null) {
        if ($o) {
            $this->set_id($o->id_sortie);
            $this->set_id_organisateur($o->id_organisateur);
            $this->set_titre($o->titre);
            $this->set_detail($o->detail);
            $this->set_debut($o->debut);
            $this->set_fin($o->fin);
        }
    }
    
    public function get_id(){
        return $this->id;
    }
    
    public function set_id($id){
        $this->id = $id;
    }
    
    public function get_id_organisateur(){
        return $this->id;
    }
    
    public function set_id_organisateur($id_organisateur){
        $this->id_organisateur = $id_organisateur;
    }
    
    public function get_titre(){
        return $this->titre;
    }
    
    public function set_titre($titre){
        $this->titre = $titre;
    }
    
    public function get_detail(){
        return $this->detail;
    }
    
    public function set_detail($detail){
        $this->detail = $detail;
    }
    
    public function get_debut(){
        return $this->debut;
    }
    
    public function set_debut($debut){
        $this->debut = $debut;
    }
    
    public function get_fin(){
        return $this->fin;
    }
    
    public function set_fin($fin){
        $this->fin = $fin;
    }
    
}