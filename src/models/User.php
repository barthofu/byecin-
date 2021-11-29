<?php

class User extends Model {

    protected int $id;
	protected string $username;
	protected string $password;
    protected string $avatar;
    protected string $admin;
	protected string $created_at;

	function __construct ($data) {

        $this->hydrate($data);
	}

    // fonctions DAO

    public function register () {

        $q = static::$_db->execQuery(
            'SELECT * FROM '. static::class .' WHERE username = :username',
            [ 'username' => $this->username ]
        );
            
        $result = $q->fetch();

        if ($result) return false;
        
        $this->add(
            'INSERT INTO '. static::class .' (username, password, avatar) VALUES (:username, :password, :avatar)',    
            [ 'username' => $this->username, 'password' => $this->password, 'avatar' => $this->avatar ]
        );

        return true;
    }

    public function login () {

        $q = static::$_db->execQuery(
            'SELECT * FROM ' . static::class . ' WHERE username = :username',
            [ 'username' => $this->username ]
        );

        $result = $q->fetch();

        if (password_verify($this->password, $result['password'])) return new self($result);
        else return false;

    }

    // ========= GETTERS ET SETTERS ==========

    public function getId() { return $this->id; }

    public function setId($id) { $this->id = $id; }

    public function getUsername() { return $this->username; }

    public function setUsername($username) { $this->username = $username; }

    public function getPassword() { return $this->password; }

    public function setPassword($password) { $this->password = $password; }

    public function getAvatar() { return $this->avatar; }

    public function setAvatar($avatar) { $this->avatar = $avatar; }

    public function getAdmin() { return $this->admin; }

    public function setAdmin($admin) { $this->admin = $admin; }

}