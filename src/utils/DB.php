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

    // fonctions utils

    public static function getAssociationsArray ($hosts, $hostForeignKey, $targets, $targetForeignKey, $associations, $associationName = 'associate') {

        $final = [];

        foreach ($hosts as $key => $value) {
            $value[$associationName] = array_filter(
                $targets,
                fn ($target) => array_filter(
                    $associations,
                    fn ($association) => $association[$hostForeignKey] == $hosts['id'] && $association[$targetForeignKey] == $target['id']
                )
            );

            array_push($final, $value);
        }

        return $final;
    }

}