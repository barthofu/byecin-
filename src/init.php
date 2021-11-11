<?php

// chargements : 

    // des constantes de configuration

require_once 'config/config.php';
require_once 'config/credentials.php';

    // du coeur de l'application : le router

require_once 'core/Router.php';

    // du système de controller de base 

require_once 'core/Controller.php';

    // du système de model de base (avec instantiation d'une connexion à la DB)

require_once 'utils/DB.php';

require_once 'core/Model.php';
Model::$_db = new DB(HOST, DB, USER, PASSWORD);

