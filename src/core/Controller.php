<?php

class Controller {

    public function model ($model) {

        require_once 'src/models/' . $model . '.php';
        return $model;
    }

    public function view ($view, $props = []) {

        $props['view'] = $view;

        //including the header, the view and the footer    
        require_once 'src/views/modules/header.php';
        require_once 'src/views/templates/' . $view . '.php';
        require_once 'src/views/modules/footer.php';
    }
}