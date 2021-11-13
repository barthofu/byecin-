<?php

class Films extends Controller {

    public function index () {

        $Film = $this->model('Film');
        $Casting = $this->model('Casting');
        $Acteur = $this->model('Acteur');

        $films = $Film::getAll();
        $castings = $Casting::getAll();
        $acteurs = $Acteur::getAll();

        $films = DB::getAssociationsArray($films, 'filmId', $acteurs, 'acteurId', $castings, 'acteurs');

        $this->view('films/index', [ 'films' => $films ]);
    }

    public function add () {

        if (!isLoggedIn()) {
            header('location: ' . str_replace('/films/add', '/', getCurrentURL()));
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