<?php
class Crypt {
    private static $cle ='aze%fzg*vbomzeg@_-';
    
    public function crypte($clair){
        $crypte = crypt($clair,'$6$rounds=5000$'.self::$cle.'$');
        $tab = explode("$",$crypte);
        return  $tab[4];
    }
    
    
}
