<?php

class Team {

    private $id;
    private $nom;
    private $logo;
    private $tag;
    private $url;
    private $nbJoueur;
    private $mdp;

    public function __construct($o = null) {
        if ($o) {
            $this->set_id($o->id_team);
            $this->set_nom($o->nom);
            $this->set_logo($o->logo);
            $this->set_tag($o->tag);
            $this->set_url($o->url);
            $this->set_nbJoueur($o->nbJoueur);
            $this->set_mdp($o->mdp);
        }
    }
    
    public function get_nbJoueur(){
        return $this->nbJoueur;
    }
    
    public function set_nbJoueur($nbJoueur){
        $this->nbJoueur = $nbJoueur;
    }
    public function get_url(){
        return $this->url;
    }
    
    public function set_url($url){
        $this->url = $url;
    }

    public function get_tag() {
        return $this->tag;
    }

    public function set_tag($tag) {
        $this->tag = $tag;
    }

    public function get_id() {
        return $this->id;
    }

    public function set_id($id) {
        $this->id = $id;
    }

    public function get_nom() {
        return $this->nom;
    }

    public function set_nom($nom) {
        $this->nom = $nom;
    }

    public function get_logo() {
        return $this->logo;
    }

    public function set_logo($logo) {
        $this->logo = $logo;
    }
    
    public function get_mdp(){
        return $this->mdp;
    }
    
    public function set_mdp($mdp){
        $this->mdp = $mdp;
    }
    


}

?>