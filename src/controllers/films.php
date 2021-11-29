<?php

class Films extends Controller {

    public function index () {

        $Film = $this->model('Film');
        $films = $Film::getAll();

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

        $Acteur = $this->model('Acteur');
        $acteurs = $Acteur::getAll();

        $data = [
            // valeurs par défaut
            'nom' => '',
            'annee' => '',
            'score' => '',
            'nbVotants' => '',
            'image' => '',
            'acteurs' => [],
            // erreurs
            'anneeError' => '',
            'scoreError' => '',
            'imageError' => '',
            // succès
            'successMessage' => '',

            // autres
            'allActeurs' => $acteurs
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
            if (isset($_POST['acteurs'])) $data['acteurs'] = $_POST['acteurs'];
            if ($_FILES['image']['tmp_name'] != '') $data['image'] = basename(
                str_replace(
                    '.tmp',
                    $_FILES['image']['type'] == 'image/png' ? '.png' : '.jpg', 
                    $_FILES['image']['tmp_name'])
            );

            $imagePath = FILMS_UPLOAD_DIR . $data['image'];

            // valide les données 
                // annee
            if ($data['annee'] > 2050 || $data['annee'] < 1800) $data['anneeError'] = 'L\'année est invalide'; 
                // score
            if ($data['score'] < 0 || $data['score'] > 10) $data['scoreError'] = 'Le score doit être compris entre 0 et 10';

            // vérifie que toutes les errors soient vides 
            if (empty($data['anneeError']) && empty($data['scoreError'])) {

                // on déplace l'image vers le dossier d'assets
                if (move_uploaded_file($_FILES['image']['tmp_name'], $imagePath)) {

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

                        $filmId = Model::$_db->lastInsertId();
                        $Casting = $this->model('Casting');

                        foreach ($data['acteurs'] as $key => $acteurId) {

                            $casting = new $Casting([
                                'filmId' => $filmId,
                                'acteurId' => $acteurId
                            ]);
                            $casting->saveOrUpdate();
                        }

                        $data['successMessage'] = $data['nom'] . ' a bien été ajouté/modifié !';
                    };
                } else {
                    $data['imageError'] = 'Une erreur est survenue avec l\'image';
                }
                
            }

        } 

        $this->view('films/add', $data);
    }

    public function delete ($params) {

        if (!isset($params['id'])) {
            header('location: ' . getURL('/'));
            exit();
        } else {

            $Film = $this->model('Film');
            $film = $Film::getById($params['id']);

            if (!$film) { // film inexistant

                // on redirige vers la home page
                header('location: ' . getURL('/'));
                exit();

            } else { // film existant

                $film->delete();

                //on supprime aussi les castings liés au film
                $Casting = $this->model('Casting');
                $castings = $Casting::getByCondition('filmId = ' . $film->getId());

                foreach ($castings as $key => $casting) {
                    $casting->delete();
                }
            }

            header('location: ' . getURL('/films'));
        }
    }

    public function vote ($params) {

        if (!isset($params['id'])) {
            header('location: ' . getURL('/'));
            exit();
        } else {

            $Film = $this->model('Film');
            $film = $Film::getById($params['id']);

            if (!$film) { // film inexistant

                // on redirige vers la home page
                header('location: ' . getURL('/'));
                exit();

            } else { // film existant

                if (!in_array($params['id'], $_SESSION['votes'])) { // l'utilisateur n'a pas encore voté pour le film -> on rajoute le vote
    
                    // ajout du vote dans la base de données
                    $film->setNbVotants($film->getNbVotants() + 1);
                    $film->saveOrUpdate();
                    // ajout du vote dans la variable de session
                    array_push($_SESSION['votes'], $params['id']);

                } else { // l'utilisateur a déjà voté pour le film -> on enlève le vote

                    // suppression du vote dans la base de données
                    $film->setNbVotants($film->getNbVotants() - 1);
                    $film->saveOrUpdate();
                    // suppression du vote dans la variable de session
                    $_SESSION['votes'] = array_diff($_SESSION['votes'], [$params['id']]);
                }

            }

            header('location: ' . getURL('/films/get?id='.$params['id']));
            exit();
        }

    }
}