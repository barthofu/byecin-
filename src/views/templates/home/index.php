<div class="home">

    <div class="title">
        Dites bye bye à AlloCiné et venez vous cultiver cinématographiquement dès maintenant sur 
        <h2>ByeCiné!</h2>
    </div>

    <div class="cardsContainer">
    <?php foreach ($data['randKeys'] as $key) { $film = $data['films'][$key]; ?>

        <div class="card" onclick="document.location.href='<?= getURI('/films/get?id='.$film->getId()) ?>'">
            <img alt="affiche" src="<?= FILMS_UPLOAD_DIR . $film->getImage() ?>">
            <h3><?= $film->getNom() ?></h3>
        </div>
        
    <?php } ?>
    </div>

</div>