<?php

class Auth extends Controller {

    public function index () {

        $this->login();
    }

    public function register () {

        if (isLoggedIn()) {
            header('location: ' . getURL('/'));
            exit();
        }

        $data = [
            // valeurs par défaut
            'username' => '',
            'password' => '',
            'confirmPassword' => '',
            // erreurs
            'usernameError' => '',
            'passwordError' => '',
            'confirmPasswordError' => ''
        ];

        // vérifie si le form d'inscription a été submit ou non
        if ($_SERVER['REQUEST_METHOD'] == 'POST') {

            // 'sanitize' les entrées du form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // on remplit les données avec celles du form
            $data['username'] = trim($_POST['username']);
            $data['password'] = trim($_POST['password']);
            $data['confirmPassword'] = trim($_POST['confirmPassword']);

            // valide les données 
                // username
            if (!preg_match(NAME_VALIDATION, $data['username'])) $data['usernameError'] = 'Le nom d\'utilisateur ne peut contenir que des lettres et des chiffres'; 
                // password
            if (strlen($data['password']) < PASSWORD_MIN_LENGTH || strlen($data['password']) > PASSWORD_MAX_LENGTH) $data['passwordError'] = 'Le mot de passe doit contenir entre 3 et 32 caractères';
            else if (preg_match(PASSWORD_VALIDATION, $data['password'])) $data['passwordError'] = 'Le mot de passe doit contenir au moins une valeure numérique';
                // confirmPassword 
            if ($data['password'] != $data['confirmPassword']) $data['confirmPasswordError'] = 'Les mots de passe ne correspondent pas, essayez encore';

            // vérifie que toutes les errors soient vides 
            if (empty($data['usernameError']) && empty($data['passwordError']) && empty($data['confirmPasswordError'])) {

                // hash du mot de passe
                $data['password'] = password_hash($data['password'], PASSWORD_DEFAULT);

                // création de l'utilisateur
                $User = $this->model('User');
                $user = new $User([ 'username' => $data['username'], 'password' => $data['password'] ]);
                
                if ($user->register()) {
                    header('location: ' . getURL('/auth/login'));
                    exit();
                }
                else $data['usernameError'] = 'Ce nom d\'utilisateur est déjà prit';

            }

        } 

        $this->view('auth/register', $data);

    }

    public function login () {

        if (isLoggedIn()) {
            header('location: ' . getURL('/'));
            exit();
        }

        $data = [
            // valeurs par défaut
            'username' => '',
            'password' => '',
            // erreurs
            'credentialsError' => '',
        ];

        if($_SERVER['REQUEST_METHOD'] == 'POST'){
           
            // 'sanitize' les entrées du form
            $_POST = filter_input_array(INPUT_POST, FILTER_SANITIZE_STRING);

            // on remplit les données avec celles du form
            $data['username'] = trim($_POST['username']);
            $data['password'] = trim($_POST['password']);

            // création de l'user en local
            $User = $this->model('User');
            $user = new $User([ 'username' => $data['username'], 'password' => $data['password'] ]);
            
            // login
            $loggedUser = $user->login();

            if ($loggedUser) $this->_createUserSession($loggedUser);
            else $data['credentialsError'] = 'Nom d\'utilisateur ou mot de passe incorrect';

        }

        $this->view('auth/login', $data);

    }

    public function logout () {

        unset($_SESSION['userId']);
        unset($_SESSION['username']);

        header('location: ' . getURL('/auth/login'));
    }

    // fonctions utils

    public function _createUserSession($loggedUser) {

        $_SESSION['userId'] = $loggedUser->getId();
        $_SESSION['username'] = $loggedUser->getUsername();

        header('location: ' . getURL('/'));
    }

}