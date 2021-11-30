<?php

class Films extends Controller {

    public function index () {

        $Film = $this->model('Film');
        $films = $Film::getAll();

        $this->view('films/index', [ 'films' => $films ]);
    }

    public function get ($params)  {

        // redirection forcée si aucun paramètre n'est passé dans l'url 
        if (!isset($params['id'])) { header('location: ' . getURL('/films')); exit(); }

        $Film = $this->model('Film');

        $data = [
            //valeurs par défaut 
            'film' => $Film::getById($params['id']),
            //erreurs
            'notFoundError' => false
        ];

        if (!$data['film']) { header('location: ' . getURL('/films'));  exit(); }

        $this->view('films/get', $data);
    }

    public function update ($params) {

        if (!isAdmin()) { header('location: ' . getURL('/'));  exit(); }
        // si aucun paramètre n'est passé dans l'url
        if (!isset($params['id'])) { header('location: ' . getURL('/films')); exit(); }

        $Acteur = $this->model('Acteur');
        $Film = $this->model('Film');

        $data = [
            'film' => $Film::getById($params['id']),
            'error' => '',
            'success' => false,
            'allActeurs' => $Acteur::getAll()            
        ];

        if (!$data['film'])  { header('location: ' . getURL('/films'));  exit(); }

        // vérifie si le form d'inscription a été submit ou non
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // on set tous les différents attributs présents dans le POST en vérifiant qu'aucun ne provoque d'erreur
            foreach (sanitizePOST() as $key => $value) {
                $method = 'set' . ucfirst($key);
                if (method_exists($data['film'], $method)) {
                    if (!$data['film']->$method($value)) {
                        $data['error'] = $key;
                        break;
                    }
                }
            }

            // s'il n'y a aucune erreur
            if ($data['error'] == '') {

                //gestion de l'image
                $imageName = moveImage('image', FILMS_UPLOAD_DIR, DEFAULT_FILM_IMAGE);
                if ($imageName !== DEFAULT_FILM_IMAGE) $data['film']->setImage($imageName);

                //enregistrement du film
                if ($data['film']->save()) {
                    //gestion du casting et des relations
                    if ($data['film']->saveCasting()) $data['success'] = true;
                    header('location: ' . getURL('/films/get?id=' . $data['film']->getId()));
                    exit();
                } else {
                    $data['error'] = 'updateFailed';
                }
            }
        }

        $this->view('films/update', $data);
    }


    public function add () {

        if (!isAdmin()) { header('location: ' . getURL('/'));  exit(); }

        $Acteur = $this->model('Acteur');

        $data = [
            'error' => '',
            'success' => false,
            'allActeurs' => $Acteur::getAll()            
        ];

        // vérifie si le form d'inscription a été submit ou non
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $Film = $this->model('Film');
            $newFilm = new $Film();

            // on set tous les différents attributs présents dans le POST en vérifiant qu'aucun ne provoque d'erreur
            foreach (sanitizePOST() as $key => $value) {
                $method = 'set' . ucfirst($key);
                if (method_exists($newFilm, $method)) {
                    if (!$newFilm->$method($value)) {
                        $data['error'] = $key;
                        break;
                    }
                }
            }

            // s'il n'y a aucune erreur
            if ($data['error'] == '') {

                //gestion de l'image
                $imageName = moveImage('image', FILMS_UPLOAD_DIR, DEFAULT_FILM_IMAGE);
                $newFilm->setImage($imageName);

                //enregistrement du film
                if ($newFilm->save()) {
                    //gestion du casting et des relations
                    if ($newFilm->saveCasting()) $data['success'] = true;
                } else {
                    $data['error'] = 'insertFailed';
                }
            }
        }

        $this->view('films/add', $data);
    }

    public function delete ($params) {

        if (!isAdmin()) { header('location: ' . getURL('/'));  exit(); }
        // si aucun paramètre n'est passé dans l'url
        if (!isset($params['id'])) { header('location: ' . getURL('/films')); exit(); }

        $Film = $this->model('Film');
        $film = $Film::getById($params['id']);

        // film non trouvé
        if (!$film) { header('location: ' . getURL('/')); exit() ; }

        //on supprime les castings liés au film
        $film->setActeurs([]);
        $film->saveCasting();

        //on supprime le film dans la base de données
        $film->delete();

        header('location: ' . getURL('/films'));
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
                    $film->save();
                    // ajout du vote dans la variable de session
                    array_push($_SESSION['votes'], $params['id']);

                } else { // l'utilisateur a déjà voté pour le film -> on enlève le vote

                    // suppression du vote dans la base de données
                    $film->setNbVotants($film->getNbVotants() - 1);
                    $film->save();
                    // suppression du vote dans la variable de session
                    $_SESSION['votes'] = array_diff($_SESSION['votes'], [$params['id']]);
                }

            }

            header('location: ' . getURL('/films/get?id='.$params['id']));
            exit();
        }

    }
}