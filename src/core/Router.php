<?php

class Router {

    protected $defaultController = 'home';
    protected $controller = '';
    protected $defaultMethod = 'index';
    protected $method = '';
    protected $params = [];

    public function __construct() {

        //parsing des paramètres de la requete (qui contiennent nottement l'url de base entrée par l'utilisateur)
        $this->parseUrl();

        //on vérifie si la route existe bien, sinon ça sera celle par défaut
        if (!file_exists('src/controllers/' . $this->controller . '.php')) $this->controller = $this->defaultController;

        //on importe le controller associé à la route
        require_once 'src/controllers/' . $this->controller . '.php';
        $this->controller = new $this->controller;

        //on vérifie maintenant s'il existe une action
        if(!method_exists($this->controller, $this->method)) $this->method = $this->defaultMethod;

        //enfin, on execute le tout
        call_user_func_array([$this->controller, $this->method], $this->params);
    }

    private function parseUrl () {

        if (!isset($_SERVER['REQUEST_URI'])) exit();

        $url = $_SERVER['REQUEST_URI'];
        $url = sanitizeWampURL($url);

        [ $baseURL, $params ] = separateParamsAndBaseURL($url);

        if (isset($baseURL[0])) $this->controller = $baseURL[0];
        if (isset($baseURL[1])) $this->method = $baseURL[1];

        $this->params = formatParams($params);
    }

}