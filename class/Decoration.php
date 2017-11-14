<?php
class Decoration {
    private $id;
    private $nom;
    private $description;
    private $img;
    private $remplace;
	private $creato;
	private $list_medaille;
	private $list_ruban;
	private $list_insigne;

    
    public function __construct($jm=null) {
        if($jm){
            $this->set_id($jm->id);
            $this->set_nom($jm->nom);
            $this->set_description($jm->description);
            $this->set_img($jm->img);
            $this->set_remplace($jm->remplace);
            $this->set_creato($jm->creato);

        }
    }
    

    
    public function get_all_medaille(){ 
        if(!$this->list_medaille){
            $decoM = new DecorationManager();
            $this->list_medaille = $decoM->get_all_medaille();
        }
        return $this->list_medaille;
    }
	
	public function get_all_ruban(){ 
        if(!$this->list_ruban){
            $decoM = new DecorationManager();
            $this->list_ruban = $decoM->get_all_ruban();
        }
        return $this->list_ruban;
    }

	public function get_all_insigne(){ 
        if(!$this->list_insigne){
            $decoM = new DecorationManager();
            $this->list_insigne = $decoM->get_all_insigne();
        }
        return $this->list_insigne;
    }	
    
   
    public function set_id($id){
        $this->id = $id;
    }
    public function get_id(){
        return $this->id;
    }
    

    
    public function get_nom(){
        return $this->nom;
    }
    public function set_nom($nom){
        $this->nom = $nom;
    }
        
    public function get_description(){
        return $this->description;
    }
    public function set_description($description){
        $this->description = $description;
    }
        
    public function get_img(){
        return $this->img;
    }
    public function set_img($img){
        $this->img = $img;
    }
        
    public function get_remplace(){
        return $this->remplace;
    }
    public function set_remplace($remplace){
        $this->remplace = $remplace;
    }
    
    public function get_creato(){
        return $this->creato;
    }
    public function set_creato($creato){
        $this->creato = $creato;
    }
    
   
    

}
?>