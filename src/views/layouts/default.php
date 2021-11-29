<?= $cssPrefix = getViewCSSPathPrefix($data['view']) ?>

<!DOCTYPE html>
<html lang="fr">

<head>
    <title><?= ucfirst(explode('/', $data['view'])[0]) ?></title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="viewport" content="width=device-width, user-scalable=no,  -scale=1.0, maximum-scale=1.0, minimum-scale=1.0">

    <link href="<?= $cssPrefix ?>public/styles/main.css" rel="stylesheet">
    <link href="<?= $cssPrefix ?>public/styles/reset.css" rel="stylesheet">
    <link href="<?= $cssPrefix ?>public/styles/fonts.css" rel="stylesheet">
    <link href="<?= $cssPrefix ?>public/styles/variables.css" rel="stylesheet">
    <link href="<?= $cssPrefix ?>public/styles/forms.css" rel="stylesheet">
    <link href="<?= $cssPrefix ?>public/styles/auth.css" rel="stylesheet">

    
</head>

<body>

<?php

    // header (navbar, etc)
    echo '<link href="'. $cssPrefix .'src/views/modules/header.css" type="text/css" rel="stylesheet">';
    require_once 'src/views/modules/header.php';

    // vue
    echo '<link href="'. $cssPrefix .'src/views/templates/'. $view .'.css" type="text/css" rel="stylesheet">';
    require_once 'src/views/templates/' . $view . '.php';

    // footer
    echo '<link href="'. $cssPrefix .'src/views/modules/footer.css" type="text/css" rel="stylesheet">';
    require_once 'src/views/modules/footer.php';

?>

    <script src="https://kit.fontawesome.com/d055a26e11.js" crossorigin="anonymous"></script>

</body>
</html>