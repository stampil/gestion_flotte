<?php

class Sortie {

    private $id;
    private $id_organisateur;
    private $titre;
    private $detail;
    private $debut;
    private $fin;
    private $id_teamspeak;
    private $visibilite;
    private $Joueur;
    private $max_joueur;
    private $Teamspeak;
    private $creato;
    private $modifo;



    public function __construct($o = null) {
        if ($o) {
            $this->set_id($o->id_sortie);
            $this->set_id_organisateur($o->id_joueur);
            $this->set_id_teamspeak($o->id_teamspeak);
            $this->set_titre($o->titre);
            $this->set_detail($o->detail);
            $this->set_debut($o->debut);
            $this->set_fin($o->fin);
            $this->set_visibilite($o->visibilite);
            $this->set_organisateur($o->id_joueur);
            $this->set_teamspeak($o->id_teamspeak);
            $this->set_creato($o->creato);
            $this->set_modifo($o->modifo);
            $this->set_max_joueur($o->max_joueur);
        }
    }
    
    public function get_id(){
        return $this->id;
    }
    
    public function set_id($id){
        $this->id = $id;
    }
    
    public function get_max_joueur(){
        return $this->max_joueur;
    }
    
    public function set_max_joueur($max_joueur){
        $this->max_joueur = $max_joueur;
    }
    
    public function get_creato(){
        return $this->creato;
    }
    
    public function set_creato($creato){
        $this->creato = $creato;
    }
    
    public function get_modifo(){
        return $this->modifo;
    }
    
    public function set_modifo($modifo){
        $this->modifo = $modifo;
    }
    
    public function get_id_organisateur(){
        return $this->id_organisateur;
    }
    
    public function set_id_organisateur($id_organisateur){
        $this->id_organisateur = $id_organisateur;
    }
    
    public function get_organisateur(){
        return $this->Joueur;
    }
    
    public function set_organisateur($id_organisateur){
        $JoueurM = new JoueurManager();
        $this->Joueur = new Joueur($JoueurM->get_joueur($id_organisateur));
    }
    
     public function get_teamspeak(){
        return $this->Teamspeak;
    }
    
    public function set_teamspeak($id_teamspeak){
        $TeamspeakM = new TeamspeakManager();
        $this->Teamspeak = new Teamspeak($TeamspeakM->get_teamspeak($id_teamspeak));
    }   

    public function get_id_teamspeak(){
        return $this->id_teamspeak;
    }
    
    public function set_id_teamspeak($id_teamspeak){
        $this->id_teamspeak = $id_teamspeak;
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
    
    public function get_visibilite(){
        return $this->visibilite;
    }
    
    public function set_visibilite($visibilite){
        $this->visibilite = $visibilite;
    }
    
}