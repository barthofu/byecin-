<?php if (!$data['notFoundError']) { 
    $film = $data['film'];
?>

    <div class="container">

        <div class="filmContainer">

            <img alt="affiche" class="filmImage" src=" <?= '../' . UPLOAD_DIR . $film->getImage() ?> ">
            <div class="filmInfos">
                <div class="filmNom"><?= $film->getNom() ?></div>

                <div class="subInfos">
                    <div class="anneeDeSortie">Année de sortie : <span><?= $film->getAnnee() ?></span></div>
                    <div class="score">Score : <span><?= $film->getScore() ?></span></div>
                    <div class="nbVotants">Nombre de votants : <span><?= $film->getNbVotants() ?></span></div>
                    <div class="acteurs">Acteurs : <span>
                        <?= implode(', ',  array_map(fn ($acteur) => $acteur->getPrenom() . ' ' .  $acteur->getNom(), $film->getActeurs()))?>
                    </span></div>
                </div>

            </div>

        </div>

        <div class="buttons">
            
            <?php if (isLoggedIn()) { ?> 
                
                <div onclick="document.location.href='<?= getURI('/films/delete?id='.$film->getId()) ?>'" class="delete">Supprimer</div>

                <a href=<?= getURI('/films/vote?id='.$film->getId()) ?> >
                    <i class="vote <?= isset($_SESSION['votes']) && in_array($film->getId(), $_SESSION['votes']) ? 'fas' : 'far' ?> fa-thumbs-up"></i>
                </a>

            <?php } ?>

        </div>

    </div>

    

<?php } else { ?>


<?php } ?>
