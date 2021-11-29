<div class="authContainer">

    <h2 class="authTitle">Inscrit toi</h2>

    <form enctype="multipart/form-data" method="POST" action="#">

        <label for="username">
            <div class="labelName">Nom d'utilisateur</div>
            <input type="text" placeholder="" name="username" required>
        </label>
        <span class="invalidFeedback">
            <?= $data['usernameError'] ?>
        </span>

        <label for="password">
            <div class="labelName">Mot de passe</div>
            <input type="password" placeholder="" name="password" required>
        </label>
        <span class="invalidFeedback">
            <?= $data['passwordError'] ?>
        </span>

        <label for="confirmPassword">
            <div class="labelName">Confirmer le mot de passe</div>
            <input type="password" placeholder="" name="confirmPassword" required>
        </label>
        <span class="invalidFeedback">
            <?= $data['confirmPasswordError'] ?>
        </span>

        <label for="avatar">
            <div class="labelName">Photo de profil</div>
            <input type="file" name="avatar" id="avatar" accept="image/png, image/jpeg">
        </label>

        <button id="submit" type="submit" value="submit">Submit</button>

        <p class="redirect">Tu possèdes déjà un compte ?<br><a href="<?= getURI('/auth/login') ?>">Connecte toi !</a></p>
    </form>
</div>
