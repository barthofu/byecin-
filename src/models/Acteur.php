<?php

class Acteur extends Model {

    protected int $id;
	protected string $nom;
	protected string $prenom;

    private array $_films = [];

	function __construct ($data = []) {

        $this->hydrate($data);
        if (isset($this->id)) {
            $this->_getFilmsFromCasting();
        }
	}

    // fonctions DAO

    // ========= RELATIONS ==========

    public function saveCasting () {

        if (!isset($this->id)) return false;

        $Casting = 'Casting';
        require_once $Casting . '.php';

        //on crée les castings manquants
        foreach ($this->_films as $key => $filmId) {
            $results = $Casting::getByCondition('acteurId = ' . $this->id . ' AND filmId = ' . $filmId);
            if (count($results) === 0) {
                $newCast = new $Casting([ 'acteurId' => $this->id, 'filmId' => $filmId ]);
                $newCast->save();
            };
        }

        //on vérifie qu'il y en ai pas en trop
        $castings = $Casting::getByCondition('acteurId = ' . $this->id);
        foreach ($castings as $key => $cast) {
            if (!in_array($cast->getFilmId() , $this->_films)) $cast->delete();
        }

        return true;
    }

    // ========= GETTERS ET SETTERS ==========

    public function hasFilm ($filmId) { 
        return in_array($filmId, $this->_films);
    }

    public function _getFilmsFromCasting () {

        $Casting = 'Casting';
        require_once $Casting . '.php';
        $casting = $Casting::getByCondition('acteurId = ' . $this->id);

        $this->_films = [];
        foreach ($casting as $key => $cast) {
            array_push($this->_films, $cast->getFilmId());
        }
    }

    public function fetchFilms () {
        
        $Film = 'Film';
        require_once $Film . '.php';

        return array_map(
            fn ($filmId) => $Film::getById($filmId),
            $this->_films
        );
    }

    public function getFilms () { return $this->_films; }

    public function setFilms ($films) { 
        $this->_films = $films; 
        return true;
    }

    public function getId() { return $this->id; }

    public function setId($id) { $this->id = $id; return true; }

    public function getNom() { return $this->nom; }

    public function setNom($nom) { $this->nom = $nom; return true; }

    public function getPrenom() { return $this->prenom; }

    public function setPrenom($prenom) { $this->prenom = $prenom; return true; }

}