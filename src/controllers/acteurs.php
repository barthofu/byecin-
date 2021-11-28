<?php

class Acteurs extends Controller {

    public function index () {

        $Acteur = $this->model('Acteur');
        $Casting = $this->model('Casting');
        $acteurs = $Acteur::getAll();
        $castings = $Casting::getAll();

        for ($i = 0; $i < count($acteurs); $i++) $acteurs[$i]->setFilms($castings);

        $this->view('acteurs/index', [ 'acteurs' => $acteurs ]);
    }

    public function get ($params)  {

        $data = [
            //valeurs par défaut 
            'acteur' => '',
            //erreurs
            'notFoundError' => false
        ];

        // si aucun paramètre n'est passé dans l'url
        if (!isset($params['id'])) {
            header('location: ' . getURL('/acteurs'));
            exit();
        }

        $Acteur = $this->model('Acteur');
        $Casting = $this->model('Casting');
        $castings = $Casting::getAll();

        $acteur = $Acteur::getById($params['id']);

        if ($acteur) {
            $acteur->setFilms($castings);
            $data['acteur'] = $acteur;
        }
        else
            $data['notFoundError'] = true;

        $this->view('acteurs/get', $data);
    }

    public function add () {

        if (!isLoggedIn()) {
            header('location: ' . getURL('/'));
            exit();
        }

        $Film = $this->model('Film');
        $films = $Film::getAll();

        $data = [
            // valeurs par défaut
            'nom' => '',
            'prenom' => '',
            // succès
            'successMessage' => '',
            
            // autres
            'allFilms' => $films
        ];

        // vérifie si le form d'inscription a été submit ou non
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // on 'sanitize' les entrées du form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // on remplit les données avec celles du form
            $data['nom'] = trim($_POST['nom']);
            $data['prenom'] = trim($_POST['prenom']);

            // création du film
            $Acteur = $this->model('Acteur');
            $acteur = new $Acteur([
                'nom' => $data['nom'],
                'prenom' => $data['prenom'],
            ]);

            if ($acteur->saveOrUpdate()) {
                $data['successMessage'] = $data['prenom'] . ' ' . $data['nom'] . ' a bien été ajouté !';
            };
        } 

        $this->view('acteurs/add', $data);
    }
}