<?php

class Home extends Controller {

    public function index () {

        $Film = $this->model('Film');
        $films = $Film::getAll();

        $this->view('home/index', [ 'films' => $films, 'randKeys' => array_rand($films, 3) ]);
    }
}