<?php

class DB extends PDO {

    function __construct($host, $db, $user, $pwd) {

        try {
            parent::__construct('mysql:host=' . $host . ';dbname=' . $db . ';charset=utf8', $user, $pwd);
        } catch (Exception $e) { 
            exit('Error :' . $e->getMessage()); 
        }
    }

    public function execQuery ($query, $args) {

        $q = $this->prepare($query);
        $q->execute($args);

        return $q;
    }

}