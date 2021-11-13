<?php

class Acteur extends Model {

    private int $id;
	private string $nom;
	private int $annee;
	private float $score;
	private int $nbVotants;
	private string $image;

	function __construct ($data) {

        $this->hydrate($data);
	}

    // fonctions DAO

    public function saveOrUpdate () {

        return $this->add(
            'INSERT INTO '. static::class .' (nom, prenom) VALUES (:nom, :prenom)',    
            get_object_vars($this)
        );
    }

    // ========= GETTERS ET SETTERS ==========

    public function getId() { return $this->id; }

    public function setId($id) { $this->id = $id; }

    public function getNom() { return $this->nom; }

    public function setNom($nom) { $this->nom = $nom; }

    public function getPrenom() { return $this->prenom; }

    public function setPrenom($prenom) { $this->prenom = $prenom; }

}