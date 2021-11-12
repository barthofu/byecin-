<!DOCTYPE html>
<html lang="fr">

<head>
    <title><?= ucfirst(explode('/', $data['view'])[0]) ?></title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no,  -scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
</head>


<body>

<nav>
    <div class="left">
        <a href="../../index.php"><h1>ByeCiné!</h1></a>
    </div>
    <div class="right">
        <a class="nav-movie" href="./movie.php">Films</a>
        <a class="nav-actors" href="./actor.php">Acteurs</a>
    </div>
</nav>