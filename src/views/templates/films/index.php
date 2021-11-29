<div class="filmsContainer">

    <div class="films">

    

        <?php foreach (array_merge($data['films'], $data['films'], $data['films']) as $key => $film) { ?>

            <a class="film" href="<?= getURI('/films/get?id='.$film->getId()) ?>">

                <img alt="affiche" class="filmImage" src=" <?= FILMS_UPLOAD_DIR . $film->getImage() ?> ">
                <div class="filmTitle"><?= $film->getNom() ?><br><span class="filmDate">(<?= $film->getAnnee() ?>)</span></div>
                
            </a>

        <?php } ?>

    </div>

    <?php if (isAdmin()) { ?>

        <a href="<?= getURI('/films/add') ?>" class="add">
            <i class="fas fa-plus"></i>
        </a>

    <?php } ?>
</div>