<div class="authContainer">
    <h2 class="authTitle">Connecte toi</h2>

    <form action="#" method ="POST">

        <span class="invalidFeedback">
            <?= $data['credentialsError'] ?>
        </span>

        <label>
            <input type="text" placeholder="Nom d'utilisateur" name="username">
        </label>

        <label>
            <input type="password" placeholder="Mot de passe" name="password">
        </label>

        <button id="submit" type="submit" value="submit">Valider</button>

        <p class="redirect">Pas encore inscrit ? <a href="<?= getURI('/auth/register') ?>">Crées-toi un compte !</a></p>
    </form>
</div>
