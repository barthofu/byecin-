<div class="films">

    <div class="filmsContainer">

    

        <?php foreach ($data['films'] as $key => $film) { ?>

            <a class="film" href="<?= getURI('/films/get?id='.$film->getId()) ?>">

                <img alt="affiche" class="filmImage" src=" <?= UPLOAD_DIR . $film->getImage() ?> ">
                <div class="filmInfos">
                    <div class="filmNom"><?= $film->getNom() ?></div>
                    <div class="subInfos">
                        <strong>Année de sortie :</strong><?= $film->getAnnee() ?><br>
                        <strong>Score :</strong><?= $film->getScore() ?><br>
                        <strong>Nombre de votants :</strong><?= $film->getNbVotants() ?><br>
                    </div>
                   
                    <!-- <details class="collapse">
                        <summary class="collapseTitle">Acteurs</summary>
                        <ul class="collapsableElements">
                        <?php implode('',  array_map(static function($acteur) { ?>

                            <li class="collapsableElement">
                                <?= $acteur->getPrenom() ?>  <?php $acteur->getNom()?>
                            </li>'

                        <?php }, $film->getActeurs())) ?>
                        </ul>
                    </details> -->
                </div>
                
            </a>

        <?php } ?>

    </div>

    <?php if (isLoggedIn()) { ?>

        <a href="<?= getURI('/films/add') ?>" class="add">
            Ajouter
        </a>

    <?php } ?>
</div>