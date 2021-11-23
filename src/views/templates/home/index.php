<div class="home">

    <div class="title">
        Dites bye bye à AlloCiné et venez vous cultiver cinématographiquement dès maintenant sur 
        <h2>ByeCiné!</h2>
    </div>

    <div class="cardsContainer">
    <?php 
        foreach ($data['randKeys'] as $key) {
            $film = $data['films'][$key];
            echo '
                <div class="card">
                    <img alt="affiche" src="'. $film->getImage() .'">
                    <h3>'. $film->getNom() .'</h3>
                </div>
            ';
        }
    ?>
    </div>

</div>