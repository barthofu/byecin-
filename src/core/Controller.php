<?php

class Controller {

    public function model ($model) {

        require_once 'src/models/' . $model . '.php';
        return $model;
    }

    public function view ($view, $data = []) {

        $data['view'] = $view;

        // on inclut le layout 
        require_once 'src/views/layouts/default.php';
    }
}