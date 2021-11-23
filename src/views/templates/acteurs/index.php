<div class="acteurs">

    <div class="acteursContainer">

        <?php foreach ($data['acteurs'] as $key => $acteur) { ?>

            <a class="acteur" href="<?= getURI('/acteurs/get?id='.$acteur->getId()) ?>">

                <div class="nom"><?= $acteur->getNom() . ' ' . $acteur->getPrenom() ?></div>
                <div class="nbOfFilms">Nombre de films : <span><?= count($acteur->getFilms()) ?></span></div>
            </a>

        <?php } ?>

    </div>

    <?php if (isLoggedIn()) { ?>

        <a href="<?= getURI('/acteurs/add') ?>" class="add">
            Ajouter
        </a>

    <?php } ?>
</div>