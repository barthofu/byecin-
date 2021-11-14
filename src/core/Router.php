<?php

class Router {

    protected $controllerName = 'home';
    protected $controller;
    protected $method = 'index';
    protected $params = [];

    public function __construct() {

        //parsing des paramètres de la requete (qui contiennent nottement l'url de base entrée par l'utilisateur)
        $req = $this->parseUrl();

        //on vérifie si la route existe bien, sinon ça sera celle par défaut à savoir 'home'
        if ($req != NULL && file_exists('../src/controllers/' . $req[0] . '.php')) {
            $this->controllerName = $req[0];
            unset($req[0]);
        }

        //on importe le controller associé à la route
        require_once '../src/controllers/' . $this->controllerName . '.php';
        $this->controller = new $this->controllerName;

        //on vérifie maintenant s'il existe une action
        if (isset($req[1])) {
            if(method_exists($this->controller, $req[1])) {
                $this->method = $req[1];
                unset($req[1]);
            }
        }

        //on parse les potentiels paramètres restants
        $this->params = $req ? array_values($req) : [];

        //enfin, on execute le tout
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function parseUrl () {

        if (isset($_GET['req'])) {
            return explode('/', filter_var(rtrim($_GET['req'], '/'), FILTER_SANITIZE_URL));
        }
    }
}