<?php
class Crypt {
    private static $cle ='aze%fzg*vbomzeg@_-';
    
    public function encode($mess) {
        $returnValue = (string) '';
        $filter = md5(self::$cle);
        $letter = -1;
        $newpass = '';
        $str = $mess;
        $strlen = strlen($str);
        $newstr = "";
        for ($i = 0; $i < $strlen; $i++) {
            $letter++;
            if ($letter > 31) {
                $letter = 0;
            }
            $neword = ord($str{$i}) + ord($filter{$letter});
            if ($neword > 255) {
                $neword -= 256;
            }
            $newstr .= chr($neword);
        }
        return str_replace("+", "[PLUS]", base64_encode($newstr));
        return (string) $returnValue;
    }
}
