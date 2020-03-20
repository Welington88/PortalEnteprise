<?php
/**
 * Description of urlBD
 *
 * @author welin
 */
class UrlBD {
    private $dsn = "mysql:host=localhost;dbname=alunos"; 
    private $username = "root"; 
    private $passwd = "";
    private $root = array("welington_marquezini88@live.com",
        "cintiapaixao.social@gmail.com","miria_2403@hotmail.com");
            
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