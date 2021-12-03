<?php

// chargements : 

    // des constantes de configuration

require_once 'config/config.php';

    // du coeur de l'application : le router

require_once 'core/Router.php';

    // du système de controller de base 

require_once 'core/Controller.php';

    // du système de model de base (avec instantiation d'une connexion à la DB)

require_once 'core/DB.php';

require_once 'core/Model.php';

Model::$_db = new DB($_ENV['DB_HOST'], $_ENV['MYSQL_DATABASE'], $_ENV['MYSQL_USER'], $_ENV['MYSQL_PASSWORD']);

    // utils

require_once 'utils/url.php';
require_once 'utils/session.php';
require_once 'utils/string.php';
require_once 'utils/image.php';