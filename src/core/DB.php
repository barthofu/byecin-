<?php

class DB extends PDO {

    function __construct($host, $db, $user, $pwd) {

        try {
            parent::__construct('mysql:host=' . $host . ';dbname=' . $db . ';charset=utf8', $user, $pwd);
            $this->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
            $this->setAttribute(PDO::ATTR_EMULATE_PREPARES, false);
        } catch (Exception $e) { 
            exit('Error :' . $e->getMessage()); 
        }
    }

    public function execQuery ($query, $args) {

        try {
            $q = $this->prepare($query);
            $q->execute($args);
        }
        catch (Exception $e) {
            echo 'Exception -> ';
            var_dump($e->getMessage());
        }
        
        return $q;
    }

}