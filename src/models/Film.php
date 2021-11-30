<?php

class Film extends Model {

    protected int $id;
	protected string $nom;
	protected int $annee;
	protected float $score;
	protected int $nbVotants;
	protected string $image;

    private array $_acteurs = [];

	function __construct ($data = []) {

        $this->hydrate($data);
        if (isset($this->id)) {
            $this->_getActeursFromCasting();
        }
	}

    // fonctions DAO


    // ========= RELATIONS ==========

    public function saveCasting () {

        if (!isset($this->id)) return false;

        $Casting = 'Casting';
        require_once $Casting . '.php';

        //on crée les castings manquants
        foreach ($this->_acteurs as $key => $acteurId) {
            $results = $Casting::getByCondition('filmId = ' . $this->id . ' AND acteurId = ' . $acteurId);
            if (count($results) === 0) {
                $newCast = new $Casting([ 'filmId' => $this->id, 'acteurId' => $acteurId ]);
                $newCast->save();
            };
        }

        //on vérifie qu'il y en ai pas en trop
        $castings = $Casting::getByCondition('filmId = ' . $this->id);
        foreach ($castings as $key => $cast) {
            if (!in_array($cast->getActeurId() , $this->_acteurs)) $cast->delete();
        }

        return true;
    }

    // ========= GETTERS ET SETTERS ==========

    public function hasActeur ($acteurId) { 
        return in_array($acteurId, $this->_acteurs);
    }

    public function _getActeursFromCasting () {

        $Casting = 'Casting';
        require_once $Casting . '.php';
        $casting = $Casting::getByCondition('filmId = ' . $this->id);

        $this->_acteurs = [];
        foreach ($casting as $key => $cast) {
            array_push($this->_acteurs, $cast->getActeurId());
        }
    }

    public function fetchActeurs () {
        
        $Acteur = 'Acteur';
        require_once $Acteur . '.php';

        return array_map(
            fn ($acteurId) => $Acteur::getById($acteurId),
            $this->_acteurs
        );
    }

    public function getActeurs () { return $this->_acteurs; }

    public function setActeurs ($acteurs) { 
        $this->_acteurs = $acteurs; 
        return true;
    }

    public function getId() { return $this->id; }

    public function setId($id) { 
        $this->id = $id; 
        return true;
    }

    public function getNom() { return $this->nom; }

    public function setNom($nom) { 
        $this->nom = $nom; 
        return true;
    }

    public function getAnnee() { return $this->annee; }

    public function setAnnee($annee) { 

        if ($annee > 2050 || $annee < 1800) return false;
        
        $this->annee = $annee; 
        return true;
    }

    public function getScore() { return $this->score; }

    public function setScore($score) { 
        
        if ($score < 0 || $score > 10) return false;

        $this->score = $score; 
        return true;
    }

    public function getNbVotants() { return $this->nbVotants; }

    public function setNbVotants($nbVotants) { 
        
        if ($nbVotants < 0) return false;

        $this->nbVotants = $nbVotants; 
        return true;
    }

    public function getImage() { return $this->image; }

    public function setImage($image) { 
        $this->image = $image; 
        return true;
    }	

}