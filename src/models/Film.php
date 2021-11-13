<?php

class Film extends Model {

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

        $q = static::$_db->execQuery(
            'SELECT * FROM '. static::class .' WHERE nom = :nom',
            [ 'nom' => $this->nom ]
        );
            
        $result = $q->fetch();

        if ($result) {

            $this->setId($result['id']);
            return $this->update(
                'UPDATE '. static::class .' SET nom = :nom, annee = :annee, score = :score, nbVotants = :nbVotants, image = :image WHERE id = :id',
                get_object_vars($this)
            );
        }
        else return $this->add(
            'INSERT INTO '. static::class .' (nom, annee, score, nbVotants, image) VALUES (:nom, :annee, :score, :nbVotants, :image)',    
            get_object_vars($this)
        );
    }

    // ========= GETTERS ET SETTERS ==========

    public function getId() { return $this->id; }

    public function setId($id) { $this->id = $id; }

    public function getNom() { return $this->nom; }

    public function setNom($nom) { $this->nom = $nom; }

    public function getAnnee() { return $this->annee; }

    public function setAnnee($annee) { $this->annee = $annee; }

    public function getScore() { return $this->score; }

    public function setScore($score) { $this->score = $score; }

    public function getNbVotants() { return $this->nbVotants; }

    public function setNbVotants($nbVotants) { $this->nbVotants = $nbVotants; }

    public function getImage() { return $this->image; }

    public function setImage($image) { $this->image = $image; }	

}