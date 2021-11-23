<?php if (!$data['notFoundError']) { 
    $acteur = $data['acteur'];
?>

    <div class="container">

        <div class="acteurContainer">

                <div class="nom"><?= $acteur->getPrenom() .' '. $acteur->getNom() ?></div>

                <div class="films">Films : <span>
                        <?= implode(', ',  array_map(fn ($film) => $film->getNom(), $acteur->getFilms()))?>
                    </span></div>

        </div>

        <div class="buttons">
            
            <?php if (isLoggedIn()) { ?> <div onclick="document.location.href='<?= getURI('/acteurs/delete?id='.$acteur->getId()) ?>'" class="delete">Supprimer</div> <?php } ?>

        </div>

    </div>

    

<?php } else { ?>


<?php } ?>
