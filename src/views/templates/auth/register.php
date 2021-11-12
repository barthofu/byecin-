<div class="register">

    <h2>Inscrit toi</h2>

    <form id="register-form" method="POST" action="#">

        <input type="text" placeholder="Nom d'utilisateur" name="username">
        <span class="invalidFeedback">
            <?= $data['usernameError'] ?>
        </span>

        <input type="password" placeholder="Mot de passe" name="password">
        <span class="invalidFeedback">
            <?= $data['passwordError'] ?>
        </span>

        <input type="password" placeholder="Confirmer le mot de passe" name="confirmPassword">
        <span class="invalidFeedback">
            <?= $data['confirmPasswordError'] ?>
        </span>

        <button id="submit" type="submit" value="submit">Submit</button>

        <p class="options">Tu possèdes déjà un compte ? <a href="<?= str_replace('/register', '/login', getCurrentURL()) ?>/users/register">Connecte toi !</a></p>
    </form>
</div>
