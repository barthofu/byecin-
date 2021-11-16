<?php

class Films extends Controller {

    public function index () {

        $Film = $this->model('Film');
        $Casting = $this->model('Casting');

        $films = $Film::getAll();
        $castings = $Casting::getAll();

        for ($i = 0; $i < count($films); $i++) $films[$i]->setActeurs($castings);

        $this->view('films/index', [ 'films' => $films ]);
    }

    public function get ($params)  {

        $data = [
            //valeurs par défaut 
            'film' => '',
            //erreurs
            'notFoundError' => false
        ];

        // si aucun paramètre n'est passé dans l'url
        if (!isset($params['id'])) {
            header('location: ' . getURL('/films'));
            exit();
        }

        $Film = $this->model('Film');
        $Casting = $this->model('Casting');
        $castings = $Casting::getAll();

        $film = $Film::getById($params['id']);

        if ($film) {

            $film->setActeurs($castings);
            $data['film'] = $film;
        } 
        else
            $data['notFoundError'] = true;

        $this->view('films/get', $data);
        
    }

    public function add () {

        if (!isLoggedIn()) {
            header('location: ' . getURL('/'));
            exit();
        }

        $data = [
            // valeurs par défaut
            'nom' => '',
            'annee' => '',
            'score' => '',
            'nbVotants' => '',
            'image' => '',
            // erreurs
            'anneeError' => '',
            'scoreError' => '',
            // succès
            'successMessage' => ''
        ];

        // vérifie si le form d'inscription a été submit ou non
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // on 'sanitize' les entrées du form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // on remplit les données avec celles du form
            $data['nom'] = trim($_POST['nom']);
            $data['annee'] = trim($_POST['annee']);
            $data['score'] = trim($_POST['score']);
            $data['nbVotants'] = trim($_POST['nbVotants']);
            $data['image'] = trim($_POST['image']);

            // valide les données 
                // annee
            if ($data['annee'] > 2050 || $data['annee'] < 1800) $data['anneeError'] = 'L\'année est invalide'; 
                // score
            if ($data['score'] < 0 || $data['score'] > 10) $data['scoreError'] = 'Le score doit être compris entre 0 et 10';

            // vérifie que toutes les errors soient vides 
            if (empty($data['anneeError']) && empty($data['scoreError'])) {

                // création du film
                $Film = $this->model('Film');
                $film = new $Film([
                    'nom' => $data['nom'],
                    'annee' => $data['annee'],
                    'score' => $data['score'],
                    'nbVotants' => $data['nbVotants'],
                    'image' => $data['image'],
                ]);

                if ($film->saveOrUpdate()) {
                    $data['successMessage'] = $data['nom'] . ' a bien été ajouté/modifié !';
                };
                
            }

        } 

        $this->view('films/add', $data);
    }
}