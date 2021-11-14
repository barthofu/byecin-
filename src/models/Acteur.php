<?php

class Acteur extends Model {

    private int $id;
	private string $nom;
	private string $prenom;

    private array $_films = [];

	function __construct ($data) {

        $this->hydrate($data);
	}

    // fonctions DAO

    public function saveOrUpdate () {

        return $this->add(
            'INSERT INTO '. static::class .' (nom, prenom) VALUES (:nom, :prenom)',    
            $this->getAttributes()
        );
    }

    // ========= GETTERS ET SETTERS ==========

    public function getFilms () { return $this->_films; }

    public function setFilms ($castings) {

        $model = 'Film';
        require_once $model . '.php';

        $this->_films = [];
        foreach ($castings as $key => $casting) {
            if ($casting->getActeurId() == $this->id) array_push($this->_films, $model::getById($casting->getFilmId()));
        }
    }

    public function getId() { return $this->id; }

    public function setId($id) { $this->id = $id; }

    public function getNom() { return $this->nom; }

    public function setNom($nom) { $this->nom = $nom; }

    public function getPrenom() { return $this->prenom; }

    public function setPrenom($prenom) { $this->prenom = $prenom; }

}