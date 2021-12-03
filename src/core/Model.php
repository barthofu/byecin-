<?php

class Model {

    public static $_db;

    // fonctions DTO 

    public function hydrate ($data) {

        foreach ($data as $key => $value) {
            $method = 'set'.ucfirst($key); //ucfirst() -> met en majuscule la première lettre pour correspondre au nom du setter
            if (method_exists($this, $method)) {
                $this->$method($value);
            }
        }
    }

    public function getAttributes ($excludes = ['id']) {

        return array_filter(get_object_vars($this), fn ($key) => !in_array($key, $excludes), ARRAY_FILTER_USE_KEY);

        // $attributes = get_object_vars($this);
        // $filteredAttributes = array_filter(
        //     $attributes,
        //     fn ($attributeKey) => !str_starts_with($attributeKey, '_'),
        //     ARRAY_FILTER_USE_KEY
        // );

        // return $filteredAttributes;
    }

    // fonctions DAO

    public function save () {

        if (isset($this->id)) return $this->update() ? true : false;
        else {
            if ($this->insert()) {
                $this->id = static::$_db->lastInsertId();
                return true;
            } else return false;
        }

    }

    public function insert () {

        $attr = $this->getAttributes();
        $keys = array_keys($attr);

        return static::$_db->execQuery(
            'INSERT INTO ' . strtolower(static::class) . ' (' . implode(', ', $keys) . ') VALUES (' . implode(', ', array_map(fn ($key) => ':'.$key, $keys)) . ')',
            $attr
        );
    }

    public function update () {

        if (!isset($this->id)) return false;

        $attr = $this->getAttributes();
        $keys = array_keys($attr);

        return static::$_db->execQuery(
            'UPDATE ' . strtolower(static::class) . ' SET ' . implode(', ', array_map(fn ($key) => $key . ' = :'.$key, $keys)) . ' WHERE id = ' . $this->id,
            $attr
        );
    }

    public function delete () {

        static::$_db->execQuery(
            'DELETE FROM '. strtolower(static::class) .' WHERE id = :id',
            [ 'id' => $this->id ]
        );
    }

    // fonctions statiques
    
    public static function getAll ($orderBy = NULL) {

        $className = strtolower(static::class);
    
        $q = static::$_db->execQuery(
            'SELECT * FROM '. $className . ($orderBy ? ' ORDER BY :orderBy' : ''),
            $orderBy ? [ 'orderBy' => $orderBy ] : []
        );
    
        $results = $q->fetchAll();
    
        return array_map(
            fn($result) => new $className($result),
            $results
        );
    }
    
    public static function getById ($id) {

        $className = strtolower(static::class);
    
        $q = static::$_db->execQuery(
            'SELECT * FROM '. $className .' WHERE id = :id',
            array( 'id' => $id )
        );

        $result = $q->fetch();

        if ($result) return new $className($result);
        else return false;
    } 

    public static function getByCondition ($condition) {
    
        $className = strtolower(static::class);

        $q = static::$_db->execQuery(
            'SELECT * FROM '. $className .' WHERE ' . $condition,
            []
        );

        $queryResults = $q->fetchAll();
        $results = [];

        foreach ($queryResults as $key => $queryResult) 
            array_push($results, new $className($queryResult));
        
        return $results;
    } 


}