<div class="acteursContainer">

    <div class="acteurs">

        <?php foreach ($data['acteurs'] as $key => $acteur) { ?>

            <a class="acteur" href="<?= getURI('/acteurs/get?id='.$acteur->getId()) ?>">

                <img alt="avatar" class="acteurAvatar" src=" <?= AVATARS_UPLOAD_DIR . '_defaultAvatar.png' ?> ">
                <div class="acteurName"><?= $acteur->getPrenom() . ' ' . $acteur->getNom() ?><br><span class="acteurNbOfFilms"><?= count($acteur->getFilms()) . ' films'?></span></div>

            </a>

        <?php } ?>

    </div>

    <?php if (isAdmin()) { ?>

        <a href="<?= getURI('/films/add') ?>" class="add">
            <i class="fas fa-plus"></i>
        </a>

<?php } ?>
</div>