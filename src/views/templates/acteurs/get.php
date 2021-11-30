<?php  
    $acteur = $data['acteur'];
?>

    <div class="container">

        <div class="acteurContainer">
            
            <div class="nom"><?= $acteur->getPrenom() .' '. $acteur->getNom() ?></div>
            <div class="acteurs">Films (<?=count($acteur->getFilms())?>) 
                <br>
                <span>
                    <?= implode(', ',  array_map(fn ($film) => $film->getNom(), $acteur->fetchFilms()))?>
                </span>
            </div>

        </div>

        <div class="buttons">
            <?php if (isAdmin()) { ?> 
                <div onclick="document.location.href='<?= getURI('/acteurs/delete?id='.$acteur->getId()) ?>'" class="submitButton delete">Supprimer</div> 
                <div onclick="document.location.href='<?= getURI('/acteurs/update?id='.$acteur->getId()) ?>'" class="submitButton modify">Modifier</div>
            <?php } ?>
        </div>

    </div>
