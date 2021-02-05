<?php
/**
 * Description of urlBD
 *
 * @author welin
 */
class UrlBD {
    private $dsn = "mysql:host=localhost:51337;dbname=localdb"; 
    private $username = "azure"; 
    private $passwd = "6#vWHD_$";
            
    function __construct() {
        
    }
    
    function getDsn() {
        return $this->dsn;
    }

    function getUsername() {
        return $this->username;
    }

    function getPasswd() {
        return $this->passwd;
    }
    
    function getRoot() {
        return $this->root;
    }
}    
?>
