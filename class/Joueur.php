<?php
class Joueur {
    private $id_joueur;
    private $handle;
    private $email;
    private $img;
    private $mdp;
    private $lastco;
    private $creato;
    private $orientation;
    private $team;
    private $admin;
    
    public function __construct($jm=null) {
        if($jm){
            $this->set_id($jm->id_joueur);
            $this->set_handle($jm->handle);
            $this->set_creato($jm->creato);
            $this->set_email($jm->email);
            $this->set_img($jm->img);
            $this->set_lastco($jm->lastco);
            $this->set_mdp($jm->mdp);
            $this->set_admin($jm->admin);
        }
    }
    
    public function get_orientation(){
        if(!$this->orientation){
            $joueurM = new JoueurManager();
            $this->orientation = $joueurM->get_orientation($this->id_joueur);
        }
        return $this->orientation;
    }
    
    public function get_team(){ 
        if(!$this->team){
            $teamM = new JoueurManager();
            $this->team = $teamM->get_team($this->id_joueur);
        }
        return $this->team;
    }
    
    public function set_id($id_joueur){
        $this->id_joueur = $id_joueur;
    }
    public function get_id(){
        return $this->id_joueur;
    }
    
    public function set_admin($admin){
        $this->admin = $admin;
    }
    public function get_admin(){
        return $this->admin;
    }
    
    public function get_handle(){
        return $this->handle;
    }
    public function set_handle($handle){
        $this->handle = $handle;
    }
        
    public function get_email(){
        return $this->email;
    }
    public function set_email($email){
        $this->email = $email;
    }
        
    public function get_img(){
        return $this->img;
    }
    public function set_img($img){
        $this->img = $img;
    }
        
    public function get_mdp(){
        return $this->mdp;
    }
    public function set_mdp($mdp){
        $this->mdp = $mdp;
    }
    
    public function get_lastco(){
        return $this->lastco;
    }
    public function set_lastco($lastco){
        $this->lastco = $lastco;
    }
    
    public function get_creato(){
        return $this->creato;
    }
    public function set_creato($creato){
        $this->creato = $creato;
    }
    
    public static function check_handle($handle){
        $url_check = "https://robertsspaceindustries.com/citizens/".$handle;
        $headers = get_headers($url_check, 1);  
        return preg_match("/200/", $headers[0]);
    }
}
?>