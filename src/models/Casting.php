<?php

class Casting extends Model {

    protected int $id;
	protected int $filmId;
	protected int $acteurId;

	function __construct ($data) {

        $this->hydrate($data);
	}

    // fonctions DAO

    // ========= GETTERS ET SETTERS ==========

    public function getId() { return $this->id; }

    public function setId($id) { $this->id = $id; }

    public function getFilmId() { return $this->filmId; }

    public function setFilmId($filmId) { $this->filmId = $filmId; }

    public function getActeurId() { return $this->acteurId; }

    public function setActeurId($acteurId) { $this->acteurId = $acteurId; }

}