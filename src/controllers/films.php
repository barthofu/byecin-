<?php

class Films extends Controller {

    public function index() {

        $this->view('films/index', []);
    }
}