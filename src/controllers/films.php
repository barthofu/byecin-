<?php

class Films extends Controller {

    public function index () {

        $filmModel = $this->model('Film');

        $films = $filmModel::getAll();

        $this->view('films/index', [ 'films' => $films]);
    }
}