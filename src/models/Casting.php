<?php

class Casting extends Model {

    private int $id;
	private int $filmId;
	private int $acteurId;

	function __construct ($data) {

        $this->hydrate($data);
	}

    // fonctions DAO

    public function saveOrUpdate () {

        return $this->add(
            'INSERT INTO '. static::class .' (filmId, acteurId) VALUES (:filmId, :acteurId)',    
            $this->getAttributes()
        );
    }

    // ========= GETTERS ET SETTERS ==========

    public function getId() { return $this->id; }

    public function setId($id) { $this->id = $id; }

    public function getFilmId() { return $this->filmId; }

    public function setFilmId($filmId) { $this->filmId = $filmId; }

    public function getActeurId() { return $this->acteurId; }

    public function setActeurId($acteurId) { $this->acteurId = $acteurId; }

}