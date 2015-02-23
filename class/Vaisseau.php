<?php
class Vaisseau {
    private $nom;
    private $img;
    private $categorie;
    private $focus;
    private $cargo;
    private $autonomie;
    private $coutReparation;
    private $nbEquipage;
    private $constructeur;
    
    public function __construct($o=null) {
        if($o){
            $this->set_nom($o->nom);
            $this->set_img($o->img);
            $this->set_categorie($o->categorie);
            $this->set_focus($o->focus);
            $this->set_cargo($o->cargo);
            $this->set_autonomie($o->autonomie);
            $this->set_coutReparation($o->coutReparation);
            $this->set_nbEquipage($o->nbEquipage);
            $this->set_constructeur($o->id_constructeur);
        }
    }
    
    public function get_constructeur(){
        return $this->constructeur;
    }
    public function set_constructeur($id_constructeur){
        $constructeurM = new ConstructeurManager();
        $constructeur = $constructeurM->get_constructeur($id_constructeur);
        $this->constructeur = new Constructeur($constructeur[0]);
    }
    
    public function get_nom(){
        return $this->nom;
    }
    public function set_nom($nom){
        $this->nom = $nom;
    }
        
    public function get_img(){
        return $this->img;
    }
    public function set_img($img){
        $this->img = $img;
    }
    
    public function get_categorie(){
        return $this->categorie;
    }
    public function set_categorie($categorie){
        $this->categorie = $categorie;
    }
    
    public function get_focus(){
        return $this->focus;
    }
    public function set_focus($focus){
        $this->focus = $focus;
    }
    
    public function get_cargo(){
        return $this->cargo;
    }
    public function set_cargo($cargo){
        $this->cargo = $cargo;
    }
    
    public function get_autonomie(){
        return $this->autonomie;
    }
    public function set_autonomie($autonomie){
        $this->autonomie = $autonomie;
    }
    
    public function get_coutReparation(){
        return $this->coutReparation;
    }
    public function set_coutReparation($coutReparation){
        $this->coutReparation = $coutReparation;
    }
    
    public function get_nbEquipage(){
        return $this->nbEquipage;
    }
    public function set_nbEquipage($nbEquipage){
        $this->nbEquipage = $nbEquipage;
    }
}
?>