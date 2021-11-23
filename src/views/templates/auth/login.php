<div class="login">
    <h2>Connecte toi</h2>

    <form action="#" method ="POST">

        <span class="invalidFeedback">
            <?= $data['credentialsError'] ?>
        </span>

        <input type="text" placeholder="Nom d'utilisateur" name="username">

        <input type="password" placeholder="Mot de passe" name="password">

        <button id="submit" type="submit" value="submit">Valider</button>

        <p class="options">Pas encore inscrit ? <a href="<?= getURL('/auth/register') ?>">Créer un compte !</a></p>
    </form>
</div>
