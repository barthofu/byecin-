<?php

class Acteurs extends Controller {

    public function index () {

        $Acteur = $this->model('Acteur');
        $acteurs = $Acteur::getAll();

        $this->view('acteurs/index', [ 'acteurs' => $acteurs ]);
    }

    public function get ($params)  {

        // redirection forcée si aucun paramètre n'est passé dans l'url 
        if (!isset($params['id'])) { header('location: ' . getURI('/acteurs')); exit(); }

        $Acteur = $this->model('Acteur');

        $data = [
            //valeurs par défaut 
            'acteur' => $Acteur::getById($params['id']),
            //erreurs
            'notFoundError' => false
        ];

        if (!$data['acteur']) { header('location: ' . getURI('/acteur'));  exit(); }

        $this->view('acteurs/get', $data);
    }

    public function update ($params) {

        if (!isAdmin()) { header('location: ' . getURI('/'));  exit(); }
        // si aucun paramètre n'est passé dans l'url
        if (!isset($params['id'])) { header('location: ' . getURI('/acteurs')); exit(); }

        $Acteur = $this->model('Acteur');
        $Film = $this->model('Film');

        $data = [
            'acteur' => $Acteur::getById($params['id']),
            'error' => '',
            'success' => false,
            'allFilms' => $Film::getAll()            
        ];

        if (!$data['acteur'])  { header('location: ' . getURI('/acteurs'));  exit(); }

        // vérifie si le form d'inscription a été submit ou non
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // on set tous les différents attributs présents dans le POST en vérifiant qu'aucun ne provoque d'erreur
            foreach (sanitizePOST() as $key => $value) {
                $method = 'set' . ucfirst($key);
                if (method_exists($data['acteur'], $method)) {
                    if (!$data['acteur']->$method($value)) {
                        $data['error'] = $key;
                        break;
                    }
                }
            }

            // s'il n'y a aucune erreur
            if ($data['error'] == '') {

                //enregistrement du film
                if ($data['acteur']->save()) {
                    //gestion du casting et des relations
                    if ($data['acteur']->saveCasting()) $data['success'] = true;
                    header('location: ' . getURI('/acteurs/get?id=' . $data['acteur']->getId()));
                    exit();
                } else {
                    $data['error'] = 'updateFailed';
                }
            }
        }

        $this->view('acteurs/update', $data);
    }

    public function add () {

        if (!isAdmin()) { header('location: ' . getURI('/'));  exit(); }

        $Film = $this->model('Film');

        $data = [
            'error' => '',
            'success' => false,
            'allFilms' => $Film::getAll()            
        ];

        // vérifie si le form d'inscription a été submit ou non
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            $Acteur = $this->model('Acteur');
            $newActeur = new $Acteur();

            // on set tous les différents attributs présents dans le POST en vérifiant qu'aucun ne provoque d'erreur
            foreach (sanitizePOST() as $key => $value) {
                $method = 'set' . ucfirst($key);
                if (method_exists($newActeur, $method)) {
                    if (!$newActeur->$method($value)) {
                        $data['error'] = $key;
                        break;
                    }
                }
            }

            // s'il n'y a aucune erreur
            if ($data['error'] == '') {

                //enregistrement du film
                if ($newActeur->save()) {
                    //gestion du casting et des relations
                    if ($newActeur->saveCasting()) $data['success'] = true;
                } else {
                    $data['error'] = 'insertFailed';
                }
            }
        }

        $this->view('acteurs/add', $data);
    }

    public function delete ($params) {

        if (!isAdmin()) { header('location: ' . getURI('/'));  exit(); }
        // si aucun paramètre n'est passé dans l'url
        if (!isset($params['id'])) { header('location: ' . getURI('/acteurs')); exit(); }

        $Acteur = $this->model('Acteur');
        $acteur = $Acteur::getById($params['id']);

        // film non trouvé
        if (!$acteur) { header('location: ' . getURI('/')); exit() ; }

        //on supprime les castings liés à l'acteur
        $acteur->setFilms([]);
        $acteur->saveCasting();

        //on supprime l'acteur dans la base de données
        $acteur->delete();

        header('location: ' . getURI('/acteurs'));
    }

}